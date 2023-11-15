<?php

namespace App\Http\Controllers;

use App\Libraries\ImageStorageLibrary;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Product;
use League\Csv\Reader;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InsertController extends Controller
{
    public function insertProduct(Request $request)
    {
        $reader  = Reader::createFromPath($request->file('file'), 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        $records = collect($records);
        $chunks = $records->chunk(100);
        foreach ($chunks as $chunk) {
            foreach ($chunk as $record) {
                $product = Product::where('product_id', $record['product_id'])->first();
                if (!empty($product)) {
                    $name = html_entity_decode($record['name']);
                    ImageStorageLibrary::updateNameFolder('product', $product->model, $name);
                    $product->name = $name;
                    $product->url = $this->create_slug($name);
                    $content = html_entity_decode($record['description']);
                    preg_match_all('/<img.*?src=["\'](.*?)["\'].*?>/i', $content, $matches);
                    foreach ($matches[1] as $image) {
                        $imageProcess = trim($image);
                        $oldPath = !Str::startsWith($imageProcess, '/') && !str_contains($imageProcess, 'http') ? Str::start($imageProcess, '/') : $imageProcess;
                        $oldPath = !str_contains($oldPath, 'http') ? "https://kingsport.vn" . trim($oldPath) : trim($oldPath);
                        $fileName = uniqid() . '_' . time() . '.' . pathinfo($oldPath, PATHINFO_EXTENSION);
                        $newPath = Http::get($oldPath)->body();
                        Storage::disk('public')->put("uploads/product/$name/content/$fileName", $newPath);
                        $content = str_replace($image, $fileName, $content);
                    }
                    $product->description = $content;
                    $product->seo_title = html_entity_decode($record['meta_title']);
                    $product->seo_description = html_entity_decode($record['meta_description']);
                    $product->seo_keywords = html_entity_decode($record['meta_keyword']);
                    $product->sorting = Product::count() + 1;
                    $product->quantity = 1;
                    $product->category_id = 10;
                    $product->save();
                }
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'success!'
        ], 200);
    }

    public function insertModelProduct(Request $request)
    {
        $reader  = Reader::createFromPath($request->file('file'), 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        $records = collect($records);
        $chunks = $records->chunk(100);
        foreach ($chunks as $chunk) {
            foreach ($chunk as $record) {
                if (intval(floatval($record["price"])) > 0) {
                    $product = new Product();
                    $model = $record['model'];
                    $product->product_id = $record['product_id'];
                    $product->status = $record['status'] == 0 ? 'off' : 'on';
                    $product->sold = $record['viewed'];
                    $product->regular_price = intval(floatval($record['price']));
                    $product->model = $record['model'];
                    $path = "https://kingsport.vn/image/" . trim($record['image']);
                    $fileName = uniqid() . '_' . time() . '.' . pathinfo($path, PATHINFO_EXTENSION);
                    $newPath = Http::timeout(90)->get($path)->body();
                    Storage::disk('public')->put("uploads/product/$model/avatar/$fileName", $newPath);
                    $product->avatar = $fileName;
                    $product->save();
                }
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'success!'
        ], 200);
    }

    public function insertSalePrice(Request $request)
    {
        $product = Product::where('name','GHẾ MASSAGE KINGSPORT G50')->get();
        dd($product);
        $reader  = Reader::createFromPath($request->file('file'), 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        $records = collect($records);
        $chunks = $records->chunk(100);
        foreach ($chunks as $chunk) {
            foreach ($chunk as $record) {
                $product = Product::where('product_id', $record['product_id'])->first();
                if (!empty($product)) {
                    $product->sale_price = intval(floatval($record['price']));
                    $product->discount = intval(round(($product->regular_price - intval(floatval($record['price']))) / $product->regular_price,2) * 100);
                    $product->save();
                }
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'success!'
        ], 200);
    }

    private function create_slug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        $string = trim($string, '-');
        return $string;
    }
}
