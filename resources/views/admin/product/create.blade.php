@extends('layouts.appAdmin')
@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Thêm sản phẩm</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm Sản phẩm
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body add-products p-0">
                    <div class="p-4">
                        <div class="row gx-5">
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                <div class="card custom-card shadow-none mb-0 border-0">
                                    <div class="card-body p-0">
                                        <div class="row gy-3">
                                            <div class="col-xl-12">
                                                <label for="product-name-add" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="product-name-add"
                                                    placeholder="Name">
                                                <label for="product-name-add"
                                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Product Name
                                                    should not exceed 30 characters</label>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-category-add" class="form-label">Category</label>
                                                <div class="choices" data-type="select-one" tabindex="0"
                                                    role="combobox" aria-autocomplete="list" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <div class="choices__inner"><select
                                                            class="form-control choices__input" data-trigger=""
                                                            name="product-category-add" id="product-category-add"
                                                            hidden="" tabindex="-1" data-choice="active">
                                                            <option value="">Category</option>
                                                        </select>
                                                        <div class="choices__list choices__list--single">
                                                            <div class="choices__item choices__placeholder choices__item--selectable"
                                                                data-item="" data-id="1" data-value=""
                                                                data-custom-properties="null" aria-selected="true">
                                                                Category</div>
                                                        </div>
                                                    </div>
                                                    <div class="choices__list choices__list--dropdown"
                                                        aria-expanded="false"><input type="text"
                                                            class="choices__input choices__input--cloned"
                                                            autocomplete="off" autocapitalize="off" spellcheck="false"
                                                            role="textbox" aria-autocomplete="list"
                                                            aria-label="Category" placeholder="Search">
                                                        <div class="choices__list" role="listbox">
                                                            <div id="choices--product-category-add-item-choice-2"
                                                                class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted"
                                                                role="option" data-choice="" data-id="2"
                                                                data-value="" data-select-text="Press to select"
                                                                data-choice-selectable="" aria-selected="true">Category
                                                            </div>
                                                            <div id="choices--product-category-add-item-choice-1"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="1"
                                                                data-value="Accesories"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Accesories</div>
                                                            <div id="choices--product-category-add-item-choice-3"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="3"
                                                                data-value="Clothing" data-select-text="Press to select"
                                                                data-choice-selectable="">Clothing</div>
                                                            <div id="choices--product-category-add-item-choice-4"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="4"
                                                                data-value="Dining" data-select-text="Press to select"
                                                                data-choice-selectable="">Dining</div>
                                                            <div id="choices--product-category-add-item-choice-5"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="5"
                                                                data-value="Ethnic &amp; Festive"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Ethnic &amp; Festive</div>
                                                            <div id="choices--product-category-add-item-choice-6"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="6"
                                                                data-value="Festive Gifts"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Festive Gifts</div>
                                                            <div id="choices--product-category-add-item-choice-7"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="7"
                                                                data-value="Footwear"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Footwear</div>
                                                            <div id="choices--product-category-add-item-choice-8"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="8"
                                                                data-value="Grooming"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Grooming</div>
                                                            <div id="choices--product-category-add-item-choice-9"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="9"
                                                                data-value="Home Decors"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Home Decors</div>
                                                            <div id="choices--product-category-add-item-choice-10"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="10"
                                                                data-value="Jewellery"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Jewellery</div>
                                                            <div id="choices--product-category-add-item-choice-11"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="11"
                                                                data-value="Kitchen"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Kitchen</div>
                                                            <div id="choices--product-category-add-item-choice-12"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="12"
                                                                data-value="Stationery"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Stationery</div>
                                                            <div id="choices--product-category-add-item-choice-13"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="13"
                                                                data-value="Toys &amp; Babycare"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Toys &amp; Babycare</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-gender-add" class="form-label">Gender</label>
                                                <div class="choices" data-type="select-one" tabindex="0"
                                                    role="combobox" aria-autocomplete="list" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <div class="choices__inner"><select
                                                            class="form-control choices__input" data-trigger=""
                                                            name="product-gender-add" id="product-gender-add"
                                                            hidden="" tabindex="-1" data-choice="active">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <div class="choices__list choices__list--single">
                                                            <div class="choices__item choices__placeholder choices__item--selectable"
                                                                data-item="" data-id="1" data-value=""
                                                                data-custom-properties="null" aria-selected="true">
                                                                Select</div>
                                                        </div>
                                                    </div>
                                                    <div class="choices__list choices__list--dropdown"
                                                        aria-expanded="false"><input type="text"
                                                            class="choices__input choices__input--cloned"
                                                            autocomplete="off" autocapitalize="off"
                                                            spellcheck="false" role="textbox"
                                                            aria-autocomplete="list" aria-label="Select"
                                                            placeholder="Search">
                                                        <div class="choices__list" role="listbox">
                                                            <div id="choices--product-gender-add-item-choice-5"
                                                                class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted"
                                                                role="option" data-choice="" data-id="5"
                                                                data-value="" data-select-text="Press to select"
                                                                data-choice-selectable="" aria-selected="true">Select
                                                            </div>
                                                            <div id="choices--product-gender-add-item-choice-1"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="1"
                                                                data-value="All" data-select-text="Press to select"
                                                                data-choice-selectable="">All</div>
                                                            <div id="choices--product-gender-add-item-choice-2"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="2"
                                                                data-value="Female" data-select-text="Press to select"
                                                                data-choice-selectable="">Female</div>
                                                            <div id="choices--product-gender-add-item-choice-3"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="3"
                                                                data-value="Male" data-select-text="Press to select"
                                                                data-choice-selectable="">Male</div>
                                                            <div id="choices--product-gender-add-item-choice-4"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="4"
                                                                data-value="Others" data-select-text="Press to select"
                                                                data-choice-selectable="">Others</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-size-add" class="form-label">Size</label>
                                                <div class="choices" data-type="select-one" tabindex="0"
                                                    role="combobox" aria-autocomplete="list" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <div class="choices__inner"><select
                                                            class="form-control choices__input" data-trigger=""
                                                            name="product-size-add" id="product-size-add"
                                                            hidden="" tabindex="-1" data-choice="active">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <div class="choices__list choices__list--single">
                                                            <div class="choices__item choices__placeholder choices__item--selectable"
                                                                data-item="" data-id="1" data-value=""
                                                                data-custom-properties="null" aria-selected="true">
                                                                Select</div>
                                                        </div>
                                                    </div>
                                                    <div class="choices__list choices__list--dropdown"
                                                        aria-expanded="false"><input type="text"
                                                            class="choices__input choices__input--cloned"
                                                            autocomplete="off" autocapitalize="off"
                                                            spellcheck="false" role="textbox"
                                                            aria-autocomplete="list" aria-label="Select"
                                                            placeholder="Search">
                                                        <div class="choices__list" role="listbox">
                                                            <div id="choices--product-size-add-item-choice-5"
                                                                class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted"
                                                                role="option" data-choice="" data-id="5"
                                                                data-value="" data-select-text="Press to select"
                                                                data-choice-selectable="" aria-selected="true">Select
                                                            </div>
                                                            <div id="choices--product-size-add-item-choice-1"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="1"
                                                                data-value="Extra Large"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Extra Large</div>
                                                            <div id="choices--product-size-add-item-choice-2"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="2"
                                                                data-value="Extra Small"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Extra Small</div>
                                                            <div id="choices--product-size-add-item-choice-3"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="3"
                                                                data-value="Large" data-select-text="Press to select"
                                                                data-choice-selectable="">Large</div>
                                                            <div id="choices--product-size-add-item-choice-4"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="4"
                                                                data-value="Medium" data-select-text="Press to select"
                                                                data-choice-selectable="">Medium</div>
                                                            <div id="choices--product-size-add-item-choice-6"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="6"
                                                                data-value="Small" data-select-text="Press to select"
                                                                data-choice-selectable="">Small</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-brand-add" class="form-label">Brand</label>
                                                <div class="choices" data-type="select-one" tabindex="0"
                                                    role="combobox" aria-autocomplete="list" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <div class="choices__inner"><select
                                                            class="form-control choices__input" data-trigger=""
                                                            name="product-brand-add" id="product-brand-add"
                                                            hidden="" tabindex="-1" data-choice="active">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <div class="choices__list choices__list--single">
                                                            <div class="choices__item choices__placeholder choices__item--selectable"
                                                                data-item="" data-id="1" data-value=""
                                                                data-custom-properties="null" aria-selected="true">
                                                                Select</div>
                                                        </div>
                                                    </div>
                                                    <div class="choices__list choices__list--dropdown"
                                                        aria-expanded="false"><input type="text"
                                                            class="choices__input choices__input--cloned"
                                                            autocomplete="off" autocapitalize="off"
                                                            spellcheck="false" role="textbox"
                                                            aria-autocomplete="list" aria-label="Select"
                                                            placeholder="Search">
                                                        <div class="choices__list" role="listbox">
                                                            <div id="choices--product-brand-add-item-choice-7"
                                                                class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted"
                                                                role="option" data-choice="" data-id="7"
                                                                data-value="" data-select-text="Press to select"
                                                                data-choice-selectable="" aria-selected="true">Select
                                                            </div>
                                                            <div id="choices--product-brand-add-item-choice-1"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="1"
                                                                data-value="Armani" data-select-text="Press to select"
                                                                data-choice-selectable="">Armani</div>
                                                            <div id="choices--product-brand-add-item-choice-2"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="2"
                                                                data-value="Arrabi" data-select-text="Press to select"
                                                                data-choice-selectable="">Arrabi</div>
                                                            <div id="choices--product-brand-add-item-choice-3"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="3"
                                                                data-value="Home Town"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Home Town</div>
                                                            <div id="choices--product-brand-add-item-choice-4"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="4"
                                                                data-value="Lacoste"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Lacoste</div>
                                                            <div id="choices--product-brand-add-item-choice-5"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="5"
                                                                data-value="Mufti" data-select-text="Press to select"
                                                                data-choice-selectable="">Mufti</div>
                                                            <div id="choices--product-brand-add-item-choice-6"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="6"
                                                                data-value="Puma" data-select-text="Press to select"
                                                                data-choice-selectable="">Puma</div>
                                                            <div id="choices--product-brand-add-item-choice-8"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="8"
                                                                data-value="Spykar" data-select-text="Press to select"
                                                                data-choice-selectable="">Spykar</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 color-selection">
                                                <label for="product-color-add" class="form-label">Colors</label>
                                                <div class="choices" data-type="select-multiple" role="combobox"
                                                    aria-autocomplete="list" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <div class="choices__inner"><select
                                                            class="form-control choices__input"
                                                            name="product-color-add" id="product-color-add"
                                                            multiple="" hidden="" tabindex="-1"
                                                            data-choice="active"></select>
                                                        <div class="choices__list choices__list--multiple"></div><input
                                                            type="text"
                                                            class="choices__input choices__input--cloned"
                                                            autocomplete="off" autocapitalize="off"
                                                            spellcheck="false" role="textbox"
                                                            aria-autocomplete="list" aria-label="false">
                                                    </div>
                                                    <div class="choices__list choices__list--dropdown"
                                                        aria-expanded="false">
                                                        <div class="choices__list" aria-multiselectable="true"
                                                            role="listbox">
                                                            <div id="choices--product-color-add-item-choice-1"
                                                                class="choices__item choices__item--choice choices__item--selectable is-highlighted"
                                                                role="option" data-choice="" data-id="1"
                                                                data-value="Black" data-select-text="Press to select"
                                                                data-choice-selectable="" aria-selected="true">Black
                                                            </div>
                                                            <div id="choices--product-color-add-item-choice-2"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="2"
                                                                data-value="Blue" data-select-text="Press to select"
                                                                data-choice-selectable="">Blue</div>
                                                            <div id="choices--product-color-add-item-choice-3"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="3"
                                                                data-value="Green" data-select-text="Press to select"
                                                                data-choice-selectable="">Green</div>
                                                            <div id="choices--product-color-add-item-choice-4"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="4"
                                                                data-value="Orange" data-select-text="Press to select"
                                                                data-choice-selectable="">Orange</div>
                                                            <div id="choices--product-color-add-item-choice-5"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="5"
                                                                data-value="Pink" data-select-text="Press to select"
                                                                data-choice-selectable="">Pink</div>
                                                            <div id="choices--product-color-add-item-choice-6"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="6"
                                                                data-value="Purple" data-select-text="Press to select"
                                                                data-choice-selectable="">Purple</div>
                                                            <div id="choices--product-color-add-item-choice-7"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="7"
                                                                data-value="Red" data-select-text="Press to select"
                                                                data-choice-selectable="">Red</div>
                                                            <div id="choices--product-color-add-item-choice-8"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="8"
                                                                data-value="White" data-select-text="Press to select"
                                                                data-choice-selectable="">White</div>
                                                            <div id="choices--product-color-add-item-choice-9"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="9"
                                                                data-value="Yellow" data-select-text="Press to select"
                                                                data-choice-selectable="">Yellow</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-cost-add" class="form-label">Enter Cost</label>
                                                <input type="text" class="form-control" id="product-cost-add"
                                                    placeholder="Cost">
                                                <label for="product-cost-add"
                                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Mention final
                                                    price of the product</label>
                                            </div>
                                            <div class="col-xl-12">
                                                <label for="product-description-add" class="form-label">Product
                                                    Description</label>
                                                <textarea class="form-control" id="product-description-add" rows="2"></textarea>
                                                <label for="product-description-add"
                                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Description
                                                    should not exceed 500 letters</label>
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="form-label">Product Features</label>
                                                <div class="ql-toolbar ql-snow"><span class="ql-formats"><span
                                                            class="ql-header ql-picker"><span class="ql-picker-label"
                                                                tabindex="0" role="button" aria-expanded="false"
                                                                aria-controls="ql-picker-options-0"><svg
                                                                    viewBox="0 0 18 18">
                                                                    <polygon class="ql-stroke"
                                                                        points="7 11 9 13 11 11 7 11"></polygon>
                                                                    <polygon class="ql-stroke"
                                                                        points="7 7 9 5 11 7 7 7"></polygon>
                                                                </svg></span><span class="ql-picker-options"
                                                                aria-hidden="true" tabindex="-1"
                                                                id="ql-picker-options-0"><span tabindex="0"
                                                                    role="button" class="ql-picker-item"
                                                                    data-value="1"></span><span tabindex="0"
                                                                    role="button" class="ql-picker-item"
                                                                    data-value="2"></span><span tabindex="0"
                                                                    role="button" class="ql-picker-item"
                                                                    data-value="3"></span><span tabindex="0"
                                                                    role="button" class="ql-picker-item"
                                                                    data-value="4"></span><span tabindex="0"
                                                                    role="button" class="ql-picker-item"
                                                                    data-value="5"></span><span tabindex="0"
                                                                    role="button" class="ql-picker-item"
                                                                    data-value="6"></span><span tabindex="0"
                                                                    role="button"
                                                                    class="ql-picker-item ql-selected"></span></span></span><select
                                                            class="ql-header" style="display: none;">
                                                            <option value="1"></option>
                                                            <option value="2"></option>
                                                            <option value="3"></option>
                                                            <option value="4"></option>
                                                            <option value="5"></option>
                                                            <option value="6"></option>
                                                            <option selected="selected"></option>
                                                        </select></span><span class="ql-formats"><span
                                                            class="ql-font ql-picker"><span class="ql-picker-label"
                                                                tabindex="0" role="button" aria-expanded="false"
                                                                aria-controls="ql-picker-options-1"><svg
                                                                    viewBox="0 0 18 18">
                                                                    <polygon class="ql-stroke"
                                                                        points="7 11 9 13 11 11 7 11"></polygon>
                                                                    <polygon class="ql-stroke"
                                                                        points="7 7 9 5 11 7 7 7"></polygon>
                                                                </svg></span><span class="ql-picker-options"
                                                                aria-hidden="true" tabindex="-1"
                                                                id="ql-picker-options-1"><span tabindex="0"
                                                                    role="button"
                                                                    class="ql-picker-item ql-selected"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item"
                                                                    data-value="serif"></span><span tabindex="0"
                                                                    role="button" class="ql-picker-item"
                                                                    data-value="monospace"></span></span></span><select
                                                            class="ql-font" style="display: none;">
                                                            <option selected="selected"></option>
                                                            <option value="serif"></option>
                                                            <option value="monospace"></option>
                                                        </select></span><span class="ql-formats"><button
                                                            type="button" class="ql-bold"><svg viewBox="0 0 18 18">
                                                                <path class="ql-stroke"
                                                                    d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z">
                                                                </path>
                                                                <path class="ql-stroke"
                                                                    d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z">
                                                                </path>
                                                            </svg></button><button type="button"
                                                            class="ql-italic"><svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="7" x2="13"
                                                                    y1="4" y2="4"></line>
                                                                <line class="ql-stroke" x1="5" x2="11"
                                                                    y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="8" x2="10"
                                                                    y1="14" y2="4"></line>
                                                            </svg></button><button type="button"
                                                            class="ql-underline"><svg viewBox="0 0 18 18">
                                                                <path class="ql-stroke"
                                                                    d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3">
                                                                </path>
                                                                <rect class="ql-fill" height="1" rx="0.5"
                                                                    ry="0.5" width="12" x="3"
                                                                    y="15"></rect>
                                                            </svg></button><button type="button"
                                                            class="ql-strike"><svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke ql-thin" x1="15.5"
                                                                    x2="2.5" y1="8.5" y2="9.5">
                                                                </line>
                                                                <path class="ql-fill"
                                                                    d="M9.007,8C6.542,7.791,6,7.519,6,6.5,6,5.792,7.283,5,9,5c1.571,0,2.765.679,2.969,1.309a1,1,0,0,0,1.9-.617C13.356,4.106,11.354,3,9,3,6.2,3,4,4.538,4,6.5a3.2,3.2,0,0,0,.5,1.843Z">
                                                                </path>
                                                                <path class="ql-fill"
                                                                    d="M8.984,10C11.457,10.208,12,10.479,12,11.5c0,0.708-1.283,1.5-3,1.5-1.571,0-2.765-.679-2.969-1.309a1,1,0,1,0-1.9.617C4.644,13.894,6.646,15,9,15c2.8,0,5-1.538,5-3.5a3.2,3.2,0,0,0-.5-1.843Z">
                                                                </path>
                                                            </svg></button></span><span class="ql-formats"><button
                                                            type="button" class="ql-blockquote"><svg
                                                                viewBox="0 0 18 18">
                                                                <rect class="ql-fill ql-stroke" height="3"
                                                                    width="3" x="4" y="5">
                                                                </rect>
                                                                <rect class="ql-fill ql-stroke" height="3"
                                                                    width="3" x="11" y="5">
                                                                </rect>
                                                                <path class="ql-even ql-fill ql-stroke"
                                                                    d="M7,8c0,4.031-3,5-3,5"></path>
                                                                <path class="ql-even ql-fill ql-stroke"
                                                                    d="M14,8c0,4.031-3,5-3,5"></path>
                                                            </svg></button><button type="button"
                                                            class="ql-code-block"><svg viewBox="0 0 18 18">
                                                                <polyline class="ql-even ql-stroke"
                                                                    points="5 7 3 9 5 11"></polyline>
                                                                <polyline class="ql-even ql-stroke"
                                                                    points="13 7 15 9 13 11"></polyline>
                                                                <line class="ql-stroke" x1="10" x2="8"
                                                                    y1="5" y2="13"></line>
                                                            </svg></button></span><span class="ql-formats"><button
                                                            type="button" class="ql-header" value="1"><svg
                                                                viewBox="0 0 18 18">
                                                                <path class="ql-fill"
                                                                    d="M10,4V14a1,1,0,0,1-2,0V10H3v4a1,1,0,0,1-2,0V4A1,1,0,0,1,3,4V8H8V4a1,1,0,0,1,2,0Zm6.06787,9.209H14.98975V7.59863a.54085.54085,0,0,0-.605-.60547h-.62744a1.01119,1.01119,0,0,0-.748.29688L11.645,8.56641a.5435.5435,0,0,0-.022.8584l.28613.30762a.53861.53861,0,0,0,.84717.0332l.09912-.08789a1.2137,1.2137,0,0,0,.2417-.35254h.02246s-.01123.30859-.01123.60547V13.209H12.041a.54085.54085,0,0,0-.605.60547v.43945a.54085.54085,0,0,0,.605.60547h4.02686a.54085.54085,0,0,0,.605-.60547v-.43945A.54085.54085,0,0,0,16.06787,13.209Z">
                                                                </path>
                                                            </svg></button><button type="button" class="ql-header"
                                                            value="2"><svg viewBox="0 0 18 18">
                                                                <path class="ql-fill"
                                                                    d="M16.73975,13.81445v.43945a.54085.54085,0,0,1-.605.60547H11.855a.58392.58392,0,0,1-.64893-.60547V14.0127c0-2.90527,3.39941-3.42187,3.39941-4.55469a.77675.77675,0,0,0-.84717-.78125,1.17684,1.17684,0,0,0-.83594.38477c-.2749.26367-.561.374-.85791.13184l-.4292-.34082c-.30811-.24219-.38525-.51758-.1543-.81445a2.97155,2.97155,0,0,1,2.45361-1.17676,2.45393,2.45393,0,0,1,2.68408,2.40918c0,2.45312-3.1792,2.92676-3.27832,3.93848h2.79443A.54085.54085,0,0,1,16.73975,13.81445ZM9,3A.99974.99974,0,0,0,8,4V8H3V4A1,1,0,0,0,1,4V14a1,1,0,0,0,2,0V10H8v4a1,1,0,0,0,2,0V4A.99974.99974,0,0,0,9,3Z">
                                                                </path>
                                                            </svg></button></span><span class="ql-formats"><button
                                                            type="button" class="ql-list" value="ordered"><svg
                                                                viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="7" x2="15"
                                                                    y1="4" y2="4"></line>
                                                                <line class="ql-stroke" x1="7" x2="15"
                                                                    y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="7" x2="15"
                                                                    y1="14" y2="14"></line>
                                                                <line class="ql-stroke ql-thin" x1="2.5"
                                                                    x2="4.5" y1="5.5" y2="5.5">
                                                                </line>
                                                                <path class="ql-fill"
                                                                    d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z">
                                                                </path>
                                                                <path class="ql-stroke ql-thin"
                                                                    d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156">
                                                                </path>
                                                                <path class="ql-stroke ql-thin"
                                                                    d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109">
                                                                </path>
                                                            </svg></button><button type="button" class="ql-list"
                                                            value="bullet"><svg viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="6" x2="15"
                                                                    y1="4" y2="4"></line>
                                                                <line class="ql-stroke" x1="6" x2="15"
                                                                    y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="6" x2="15"
                                                                    y1="14" y2="14"></line>
                                                                <line class="ql-stroke" x1="3" x2="3"
                                                                    y1="4" y2="4"></line>
                                                                <line class="ql-stroke" x1="3" x2="3"
                                                                    y1="9" y2="9"></line>
                                                                <line class="ql-stroke" x1="3" x2="3"
                                                                    y1="14" y2="14"></line>
                                                            </svg></button></span><span class="ql-formats"><span
                                                            class="ql-color ql-picker ql-color-picker"><span
                                                                class="ql-picker-label" tabindex="0" role="button"
                                                                aria-expanded="false"
                                                                aria-controls="ql-picker-options-2"><svg
                                                                    viewBox="0 0 18 18">
                                                                    <line
                                                                        class="ql-color-label ql-stroke ql-transparent"
                                                                        x1="3" x2="15" y1="15"
                                                                        y2="15"></line>
                                                                    <polyline class="ql-stroke"
                                                                        points="5.5 11 9 3 12.5 11"></polyline>
                                                                    <line class="ql-stroke" x1="11.63"
                                                                        x2="6.38" y1="9" y2="9">
                                                                    </line>
                                                                </svg></span><span class="ql-picker-options"
                                                                aria-hidden="true" tabindex="-1"
                                                                id="ql-picker-options-2"><span tabindex="0"
                                                                    role="button"
                                                                    class="ql-picker-item ql-selected ql-primary"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#e60000"
                                                                    style="background-color: rgb(230, 0, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#ff9900"
                                                                    style="background-color: rgb(255, 153, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#ffff00"
                                                                    style="background-color: rgb(255, 255, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#008a00"
                                                                    style="background-color: rgb(0, 138, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#0066cc"
                                                                    style="background-color: rgb(0, 102, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#9933ff"
                                                                    style="background-color: rgb(153, 51, 255);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ffffff"
                                                                    style="background-color: rgb(255, 255, 255);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#facccc"
                                                                    style="background-color: rgb(250, 204, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ffebcc"
                                                                    style="background-color: rgb(255, 235, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ffffcc"
                                                                    style="background-color: rgb(255, 255, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#cce8cc"
                                                                    style="background-color: rgb(204, 232, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#cce0f5"
                                                                    style="background-color: rgb(204, 224, 245);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ebd6ff"
                                                                    style="background-color: rgb(235, 214, 255);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#bbbbbb"
                                                                    style="background-color: rgb(187, 187, 187);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#f06666"
                                                                    style="background-color: rgb(240, 102, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ffc266"
                                                                    style="background-color: rgb(255, 194, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ffff66"
                                                                    style="background-color: rgb(255, 255, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#66b966"
                                                                    style="background-color: rgb(102, 185, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#66a3e0"
                                                                    style="background-color: rgb(102, 163, 224);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#c285ff"
                                                                    style="background-color: rgb(194, 133, 255);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#888888"
                                                                    style="background-color: rgb(136, 136, 136);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#a10000"
                                                                    style="background-color: rgb(161, 0, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#b26b00"
                                                                    style="background-color: rgb(178, 107, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#b2b200"
                                                                    style="background-color: rgb(178, 178, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#006100"
                                                                    style="background-color: rgb(0, 97, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#0047b2"
                                                                    style="background-color: rgb(0, 71, 178);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#6b24b2"
                                                                    style="background-color: rgb(107, 36, 178);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#444444"
                                                                    style="background-color: rgb(68, 68, 68);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#5c0000"
                                                                    style="background-color: rgb(92, 0, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#663d00"
                                                                    style="background-color: rgb(102, 61, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#666600"
                                                                    style="background-color: rgb(102, 102, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#003700"
                                                                    style="background-color: rgb(0, 55, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#002966"
                                                                    style="background-color: rgb(0, 41, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#3d1466"
                                                                    style="background-color: rgb(61, 20, 102);"></span></span></span><select
                                                            class="ql-color" style="display: none;">
                                                            <option selected="selected"></option>
                                                            <option value="#e60000"></option>
                                                            <option value="#ff9900"></option>
                                                            <option value="#ffff00"></option>
                                                            <option value="#008a00"></option>
                                                            <option value="#0066cc"></option>
                                                            <option value="#9933ff"></option>
                                                            <option value="#ffffff"></option>
                                                            <option value="#facccc"></option>
                                                            <option value="#ffebcc"></option>
                                                            <option value="#ffffcc"></option>
                                                            <option value="#cce8cc"></option>
                                                            <option value="#cce0f5"></option>
                                                            <option value="#ebd6ff"></option>
                                                            <option value="#bbbbbb"></option>
                                                            <option value="#f06666"></option>
                                                            <option value="#ffc266"></option>
                                                            <option value="#ffff66"></option>
                                                            <option value="#66b966"></option>
                                                            <option value="#66a3e0"></option>
                                                            <option value="#c285ff"></option>
                                                            <option value="#888888"></option>
                                                            <option value="#a10000"></option>
                                                            <option value="#b26b00"></option>
                                                            <option value="#b2b200"></option>
                                                            <option value="#006100"></option>
                                                            <option value="#0047b2"></option>
                                                            <option value="#6b24b2"></option>
                                                            <option value="#444444"></option>
                                                            <option value="#5c0000"></option>
                                                            <option value="#663d00"></option>
                                                            <option value="#666600"></option>
                                                            <option value="#003700"></option>
                                                            <option value="#002966"></option>
                                                            <option value="#3d1466"></option>
                                                        </select><span
                                                            class="ql-background ql-picker ql-color-picker"><span
                                                                class="ql-picker-label" tabindex="0"
                                                                role="button" aria-expanded="false"
                                                                aria-controls="ql-picker-options-3"><svg
                                                                    viewBox="0 0 18 18">
                                                                    <g class="ql-fill ql-color-label">
                                                                        <polygon
                                                                            points="6 6.868 6 6 5 6 5 7 5.942 7 6 6.868">
                                                                        </polygon>
                                                                        <rect height="1" width="1"
                                                                            x="4" y="4"></rect>
                                                                        <polygon
                                                                            points="6.817 5 6 5 6 6 6.38 6 6.817 5">
                                                                        </polygon>
                                                                        <rect height="1" width="1"
                                                                            x="2" y="6"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="3" y="5"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="4" y="7"></rect>
                                                                        <polygon
                                                                            points="4 11.439 4 11 3 11 3 12 3.755 12 4 11.439">
                                                                        </polygon>
                                                                        <rect height="1" width="1"
                                                                            x="2" y="12"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="2" y="9"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="2" y="15"></rect>
                                                                        <polygon
                                                                            points="4.63 10 4 10 4 11 4.192 11 4.63 10">
                                                                        </polygon>
                                                                        <rect height="1" width="1"
                                                                            x="3" y="8"></rect>
                                                                        <path
                                                                            d="M10.832,4.2L11,4.582V4H10.708A1.948,1.948,0,0,1,10.832,4.2Z">
                                                                        </path>
                                                                        <path
                                                                            d="M7,4.582L7.168,4.2A1.929,1.929,0,0,1,7.292,4H7V4.582Z">
                                                                        </path>
                                                                        <path
                                                                            d="M8,13H7.683l-0.351.8a1.933,1.933,0,0,1-.124.2H8V13Z">
                                                                        </path>
                                                                        <rect height="1" width="1"
                                                                            x="12" y="2"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="11" y="3"></rect>
                                                                        <path d="M9,3H8V3.282A1.985,1.985,0,0,1,9,3Z">
                                                                        </path>
                                                                        <rect height="1" width="1"
                                                                            x="2" y="3"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="6" y="2"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="3" y="2"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="5" y="3"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="9" y="2"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="15" y="14"></rect>
                                                                        <polygon
                                                                            points="13.447 10.174 13.469 10.225 13.472 10.232 13.808 11 14 11 14 10 13.37 10 13.447 10.174">
                                                                        </polygon>
                                                                        <rect height="1" width="1"
                                                                            x="13" y="7"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="15" y="5"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="14" y="6"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="15" y="8"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="14" y="9"></rect>
                                                                        <path
                                                                            d="M3.775,14H3v1H4V14.314A1.97,1.97,0,0,1,3.775,14Z">
                                                                        </path>
                                                                        <rect height="1" width="1"
                                                                            x="14" y="3"></rect>
                                                                        <polygon
                                                                            points="12 6.868 12 6 11.62 6 12 6.868">
                                                                        </polygon>
                                                                        <rect height="1" width="1"
                                                                            x="15" y="2"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="12" y="5"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="13" y="4"></rect>
                                                                        <polygon
                                                                            points="12.933 9 13 9 13 8 12.495 8 12.933 9">
                                                                        </polygon>
                                                                        <rect height="1" width="1"
                                                                            x="9" y="14"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="8" y="15"></rect>
                                                                        <path
                                                                            d="M6,14.926V15H7V14.316A1.993,1.993,0,0,1,6,14.926Z">
                                                                        </path>
                                                                        <rect height="1" width="1"
                                                                            x="5" y="15"></rect>
                                                                        <path
                                                                            d="M10.668,13.8L10.317,13H10v1h0.792A1.947,1.947,0,0,1,10.668,13.8Z">
                                                                        </path>
                                                                        <rect height="1" width="1"
                                                                            x="11" y="15"></rect>
                                                                        <path
                                                                            d="M14.332,12.2a1.99,1.99,0,0,1,.166.8H15V12H14.245Z">
                                                                        </path>
                                                                        <rect height="1" width="1"
                                                                            x="14" y="15"></rect>
                                                                        <rect height="1" width="1"
                                                                            x="15" y="11"></rect>
                                                                    </g>
                                                                    <polyline class="ql-stroke"
                                                                        points="5.5 13 9 5 12.5 13"></polyline>
                                                                    <line class="ql-stroke" x1="11.63"
                                                                        x2="6.38" y1="11"
                                                                        y2="11"></line>
                                                                </svg></span><span class="ql-picker-options"
                                                                aria-hidden="true" tabindex="-1"
                                                                id="ql-picker-options-3"><span tabindex="0"
                                                                    role="button" class="ql-picker-item ql-primary"
                                                                    data-value="#000000"
                                                                    style="background-color: rgb(0, 0, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#e60000"
                                                                    style="background-color: rgb(230, 0, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#ff9900"
                                                                    style="background-color: rgb(255, 153, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#ffff00"
                                                                    style="background-color: rgb(255, 255, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#008a00"
                                                                    style="background-color: rgb(0, 138, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#0066cc"
                                                                    style="background-color: rgb(0, 102, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-primary"
                                                                    data-value="#9933ff"
                                                                    style="background-color: rgb(153, 51, 255);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item ql-selected"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#facccc"
                                                                    style="background-color: rgb(250, 204, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ffebcc"
                                                                    style="background-color: rgb(255, 235, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ffffcc"
                                                                    style="background-color: rgb(255, 255, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#cce8cc"
                                                                    style="background-color: rgb(204, 232, 204);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#cce0f5"
                                                                    style="background-color: rgb(204, 224, 245);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ebd6ff"
                                                                    style="background-color: rgb(235, 214, 255);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#bbbbbb"
                                                                    style="background-color: rgb(187, 187, 187);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#f06666"
                                                                    style="background-color: rgb(240, 102, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ffc266"
                                                                    style="background-color: rgb(255, 194, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#ffff66"
                                                                    style="background-color: rgb(255, 255, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#66b966"
                                                                    style="background-color: rgb(102, 185, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#66a3e0"
                                                                    style="background-color: rgb(102, 163, 224);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#c285ff"
                                                                    style="background-color: rgb(194, 133, 255);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#888888"
                                                                    style="background-color: rgb(136, 136, 136);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#a10000"
                                                                    style="background-color: rgb(161, 0, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#b26b00"
                                                                    style="background-color: rgb(178, 107, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#b2b200"
                                                                    style="background-color: rgb(178, 178, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#006100"
                                                                    style="background-color: rgb(0, 97, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#0047b2"
                                                                    style="background-color: rgb(0, 71, 178);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#6b24b2"
                                                                    style="background-color: rgb(107, 36, 178);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#444444"
                                                                    style="background-color: rgb(68, 68, 68);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#5c0000"
                                                                    style="background-color: rgb(92, 0, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#663d00"
                                                                    style="background-color: rgb(102, 61, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#666600"
                                                                    style="background-color: rgb(102, 102, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#003700"
                                                                    style="background-color: rgb(0, 55, 0);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#002966"
                                                                    style="background-color: rgb(0, 41, 102);"></span><span
                                                                    tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="#3d1466"
                                                                    style="background-color: rgb(61, 20, 102);"></span></span></span><select
                                                            class="ql-background" style="display: none;">
                                                            <option value="#000000"></option>
                                                            <option value="#e60000"></option>
                                                            <option value="#ff9900"></option>
                                                            <option value="#ffff00"></option>
                                                            <option value="#008a00"></option>
                                                            <option value="#0066cc"></option>
                                                            <option value="#9933ff"></option>
                                                            <option selected="selected"></option>
                                                            <option value="#facccc"></option>
                                                            <option value="#ffebcc"></option>
                                                            <option value="#ffffcc"></option>
                                                            <option value="#cce8cc"></option>
                                                            <option value="#cce0f5"></option>
                                                            <option value="#ebd6ff"></option>
                                                            <option value="#bbbbbb"></option>
                                                            <option value="#f06666"></option>
                                                            <option value="#ffc266"></option>
                                                            <option value="#ffff66"></option>
                                                            <option value="#66b966"></option>
                                                            <option value="#66a3e0"></option>
                                                            <option value="#c285ff"></option>
                                                            <option value="#888888"></option>
                                                            <option value="#a10000"></option>
                                                            <option value="#b26b00"></option>
                                                            <option value="#b2b200"></option>
                                                            <option value="#006100"></option>
                                                            <option value="#0047b2"></option>
                                                            <option value="#6b24b2"></option>
                                                            <option value="#444444"></option>
                                                            <option value="#5c0000"></option>
                                                            <option value="#663d00"></option>
                                                            <option value="#666600"></option>
                                                            <option value="#003700"></option>
                                                            <option value="#002966"></option>
                                                            <option value="#3d1466"></option>
                                                        </select></span><span class="ql-formats"><span
                                                            class="ql-align ql-picker ql-icon-picker"><span
                                                                class="ql-picker-label" tabindex="0"
                                                                role="button" aria-expanded="false"
                                                                aria-controls="ql-picker-options-4"><svg
                                                                    viewBox="0 0 18 18">
                                                                    <line class="ql-stroke" x1="3"
                                                                        x2="15" y1="9"
                                                                        y2="9"></line>
                                                                    <line class="ql-stroke" x1="3"
                                                                        x2="13" y1="14"
                                                                        y2="14"></line>
                                                                    <line class="ql-stroke" x1="3"
                                                                        x2="9" y1="4"
                                                                        y2="4"></line>
                                                                </svg></span><span class="ql-picker-options"
                                                                aria-hidden="true" tabindex="-1"
                                                                id="ql-picker-options-4"><span tabindex="0"
                                                                    role="button"
                                                                    class="ql-picker-item ql-selected"><svg
                                                                        viewBox="0 0 18 18">
                                                                        <line class="ql-stroke" x1="3"
                                                                            x2="15" y1="9"
                                                                            y2="9"></line>
                                                                        <line class="ql-stroke" x1="3"
                                                                            x2="13" y1="14"
                                                                            y2="14"></line>
                                                                        <line class="ql-stroke" x1="3"
                                                                            x2="9" y1="4"
                                                                            y2="4"></line>
                                                                    </svg></span><span tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="center"><svg
                                                                        viewBox="0 0 18 18">
                                                                        <line class="ql-stroke" x1="15"
                                                                            x2="3" y1="9"
                                                                            y2="9"></line>
                                                                        <line class="ql-stroke" x1="14"
                                                                            x2="4" y1="14"
                                                                            y2="14"></line>
                                                                        <line class="ql-stroke" x1="12"
                                                                            x2="6" y1="4"
                                                                            y2="4"></line>
                                                                    </svg></span><span tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="right"><svg
                                                                        viewBox="0 0 18 18">
                                                                        <line class="ql-stroke" x1="15"
                                                                            x2="3" y1="9"
                                                                            y2="9"></line>
                                                                        <line class="ql-stroke" x1="15"
                                                                            x2="5" y1="14"
                                                                            y2="14"></line>
                                                                        <line class="ql-stroke" x1="15"
                                                                            x2="9" y1="4"
                                                                            y2="4"></line>
                                                                    </svg></span><span tabindex="0" role="button"
                                                                    class="ql-picker-item" data-value="justify"><svg
                                                                        viewBox="0 0 18 18">
                                                                        <line class="ql-stroke" x1="15"
                                                                            x2="3" y1="9"
                                                                            y2="9"></line>
                                                                        <line class="ql-stroke" x1="15"
                                                                            x2="3" y1="14"
                                                                            y2="14"></line>
                                                                        <line class="ql-stroke" x1="15"
                                                                            x2="3" y1="4"
                                                                            y2="4"></line>
                                                                    </svg></span></span></span><select
                                                            class="ql-align" style="display: none;">
                                                            <option selected="selected"></option>
                                                            <option value="center"></option>
                                                            <option value="right"></option>
                                                            <option value="justify"></option>
                                                        </select></span><span class="ql-formats"><button
                                                            type="button" class="ql-clean"><svg class=""
                                                                viewBox="0 0 18 18">
                                                                <line class="ql-stroke" x1="5"
                                                                    x2="13" y1="3" y2="3">
                                                                </line>
                                                                <line class="ql-stroke" x1="6"
                                                                    x2="9.35" y1="12" y2="3">
                                                                </line>
                                                                <line class="ql-stroke" x1="11"
                                                                    x2="15" y1="11" y2="15">
                                                                </line>
                                                                <line class="ql-stroke" x1="15"
                                                                    x2="11" y1="11" y2="15">
                                                                </line>
                                                                <rect class="ql-fill" height="1"
                                                                    rx="0.5" ry="0.5" width="7"
                                                                    x="2" y="14"></rect>
                                                            </svg></button></span></div>
                                                <div id="product-features" class="ql-container ql-snow">
                                                    <div class="ql-editor ql-blank" data-gramm="false"
                                                        contenteditable="true">
                                                        <p><br></p>
                                                    </div>
                                                    <div class="ql-clipboard" contenteditable="true"
                                                        tabindex="-1"></div>
                                                    <div class="ql-tooltip ql-hidden"><a class="ql-preview"
                                                            rel="noopener noreferrer" target="_blank"
                                                            href="about:blank"></a><input type="text"
                                                            data-formula="e=mc^2" data-link="https://quilljs.com"
                                                            data-video="Embed URL"><a class="ql-action"></a><a
                                                            class="ql-remove"></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                <div class="card custom-card shadow-none mb-0 border-0">
                                    <div class="card-body p-0">
                                        <div class="row gy-4">
                                            <div class="col-xl-4">
                                                <label for="product-actual-price" class="form-label">Actual
                                                    Price</label>
                                                <input type="text" class="form-control"
                                                    id="product-actual-price" placeholder="Actual Price">
                                            </div>
                                            <div class="col-xl-4">
                                                <label for="product-dealer-price" class="form-label">Dealer
                                                    Price</label>
                                                <input type="text" class="form-control"
                                                    id="product-dealer-price" placeholder="Dealer Price">
                                            </div>
                                            <div class="col-xl-4">
                                                <label for="product-discount" class="form-label">Discount</label>
                                                <input type="text" class="form-control" id="product-discount"
                                                    placeholder="Discount in %">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-type" class="form-label">Product Type</label>
                                                <input type="text" class="form-control" id="product-type"
                                                    placeholder="Type">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-discount" class="form-label">Item Weight</label>
                                                <input type="text" class="form-control" id="product-discount1"
                                                    placeholder="Weight in gms">
                                            </div>
                                            <div class="col-xl-12 product-documents-container">
                                                <p class="fw-semibold mb-2 fs-14">Product Images :</p>
                                                <div class="filepond--root product-Images filepond--hopper"
                                                    data-style-button-remove-item-position="left"
                                                    data-style-button-process-item-position="right"
                                                    data-style-load-indicator-position="right"
                                                    data-style-progress-indicator-position="right"
                                                    data-style-button-remove-item-align="false"
                                                    style="height: 76px;"><input class="filepond--browser"
                                                        type="file" id="filepond--browser-4rcd6vj74"
                                                        name="filepond"
                                                        aria-controls="filepond--assistant-4rcd6vj74"
                                                        aria-labelledby="filepond--drop-label-4rcd6vj74"
                                                        multiple=""><a class="filepond--credits"
                                                        aria-hidden="true" href="https://pqina.nl/"
                                                        target="_blank" rel="noopener noreferrer"
                                                        style="transform: translateY(68px);">Powered by PQINA</a>
                                                    <div class="filepond--drop-label"
                                                        style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
                                                        <label for="filepond--browser-4rcd6vj74"
                                                            id="filepond--drop-label-4rcd6vj74"
                                                            aria-hidden="true">Drag &amp; Drop your files or <span
                                                                class="filepond--label-action"
                                                                tabindex="0">Browse</span></label></div>
                                                    <div class="filepond--list-scroller"
                                                        style="transform: translate3d(0px, 60px, 0px);">
                                                        <ul class="filepond--list" role="list"></ul>
                                                    </div>
                                                    <div class="filepond--panel filepond--panel-root"
                                                        data-scalable="true">
                                                        <div class="filepond--panel-top filepond--panel-root"></div>
                                                        <div class="filepond--panel-center filepond--panel-root"
                                                            style="transform: translate3d(0px, 8px, 0px) scale3d(1, 0.6, 1);">
                                                        </div>
                                                        <div class="filepond--panel-bottom filepond--panel-root"
                                                            style="transform: translate3d(0px, 68px, 0px);"></div>
                                                    </div><span class="filepond--assistant"
                                                        id="filepond--assistant-4rcd6vj74" role="status"
                                                        aria-live="polite" aria-relevant="additions"></span>
                                                    <div class="filepond--drip"></div>
                                                    <fieldset class="filepond--data"></fieldset>
                                                </div>
                                            </div>
                                            <label class="form-label op-5 mt-3">Minimum 0f 6 images are need to be
                                                uploaded,make sure the image size match the proper background size and
                                                all images should be uniformly maintained with width and height to the
                                                image container,image size should not exceed 2MB,once uploaded to change
                                                the image you need to wait minimum of 24hrs. </label>
                                            <div class="col-xl-12 product-documents-container">
                                                <p class="fw-semibold mb-2 fs-14">Warrenty Documents :</p>
                                                <div class="filepond--root product-documents filepond--hopper"
                                                    data-style-button-remove-item-position="left"
                                                    data-style-button-process-item-position="right"
                                                    data-style-load-indicator-position="right"
                                                    data-style-progress-indicator-position="right"
                                                    data-style-button-remove-item-align="false"
                                                    style="height: 76px;"><input class="filepond--browser"
                                                        type="file" id="filepond--browser-thwzwiwzq"
                                                        name="filepond"
                                                        aria-controls="filepond--assistant-thwzwiwzq"
                                                        aria-labelledby="filepond--drop-label-thwzwiwzq"
                                                        multiple=""><a class="filepond--credits"
                                                        aria-hidden="true" href="https://pqina.nl/"
                                                        target="_blank" rel="noopener noreferrer"
                                                        style="transform: translateY(68px);">Powered by PQINA</a>
                                                    <div class="filepond--drop-label"
                                                        style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
                                                        <label for="filepond--browser-thwzwiwzq"
                                                            id="filepond--drop-label-thwzwiwzq"
                                                            aria-hidden="true">Drag &amp; Drop your files or <span
                                                                class="filepond--label-action"
                                                                tabindex="0">Browse</span></label></div>
                                                    <div class="filepond--list-scroller"
                                                        style="transform: translate3d(0px, 60px, 0px);">
                                                        <ul class="filepond--list" role="list"></ul>
                                                    </div>
                                                    <div class="filepond--panel filepond--panel-root"
                                                        data-scalable="true">
                                                        <div class="filepond--panel-top filepond--panel-root"></div>
                                                        <div class="filepond--panel-center filepond--panel-root"
                                                            style="transform: translate3d(0px, 8px, 0px) scale3d(1, 0.6, 1);">
                                                        </div>
                                                        <div class="filepond--panel-bottom filepond--panel-root"
                                                            style="transform: translate3d(0px, 68px, 0px);"></div>
                                                    </div><span class="filepond--assistant"
                                                        id="filepond--assistant-thwzwiwzq" role="status"
                                                        aria-live="polite" aria-relevant="additions"></span>
                                                    <div class="filepond--drip"></div>
                                                    <fieldset class="filepond--data"></fieldset>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="publish-date" class="form-label">Publish Date</label>
                                                <input type="text" class="form-control flatpickr-input"
                                                    id="publish-date" placeholder="Choose date"
                                                    readonly="readonly">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="publish-time" class="form-label">Publish Time</label>
                                                <input type="text" class="form-control flatpickr-input"
                                                    id="publish-time" placeholder="Choose time"
                                                    readonly="readonly">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-status-add" class="form-label">Published
                                                    Status</label>
                                                <div class="choices" data-type="select-one" tabindex="0"
                                                    role="combobox" aria-autocomplete="list" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <div class="choices__inner"><select
                                                            class="form-control choices__input" data-trigger=""
                                                            name="product-status-add" id="product-status-add"
                                                            hidden="" tabindex="-1" data-choice="active">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <div class="choices__list choices__list--single">
                                                            <div class="choices__item choices__placeholder choices__item--selectable"
                                                                data-item="" data-id="1" data-value=""
                                                                data-custom-properties="null" aria-selected="true">
                                                                Select</div>
                                                        </div>
                                                    </div>
                                                    <div class="choices__list choices__list--dropdown"
                                                        aria-expanded="false"><input type="text"
                                                            class="choices__input choices__input--cloned"
                                                            autocomplete="off" autocapitalize="off"
                                                            spellcheck="false" role="textbox"
                                                            aria-autocomplete="list" aria-label="Select"
                                                            placeholder="Search">
                                                        <div class="choices__list" role="listbox">
                                                            <div id="choices--product-status-add-item-choice-3"
                                                                class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted"
                                                                role="option" data-choice="" data-id="3"
                                                                data-value="" data-select-text="Press to select"
                                                                data-choice-selectable="" aria-selected="true">
                                                                Select</div>
                                                            <div id="choices--product-status-add-item-choice-1"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="1"
                                                                data-value="Published"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Published</div>
                                                            <div id="choices--product-status-add-item-choice-2"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="2"
                                                                data-value="Scheduled"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Scheduled</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-tags" class="form-label">Product Tags</label>
                                                <div class="choices" data-type="select-multiple" role="combobox"
                                                    aria-autocomplete="list" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <div class="choices__inner"><select
                                                            class="form-control choices__input" name="product-tags"
                                                            id="product-tags" multiple="" hidden=""
                                                            tabindex="-1" data-choice="active">
                                                            <option value="Plain">Plain</option>
                                                            <option value="Relaxed">Relaxed</option>
                                                        </select>
                                                        <div class="choices__list choices__list--multiple">
                                                            <div class="choices__item choices__item--selectable"
                                                                data-item="" data-id="1" data-value="Plain"
                                                                data-custom-properties="null" aria-selected="true"
                                                                data-deletable="">Plain<button type="button"
                                                                    class="choices__button"
                                                                    aria-label="Remove item: 'Plain'"
                                                                    data-button="">Remove item</button></div>
                                                            <div class="choices__item choices__item--selectable"
                                                                data-item="" data-id="2" data-value="Relaxed"
                                                                data-custom-properties="null" aria-selected="true"
                                                                data-deletable="">Relaxed<button type="button"
                                                                    class="choices__button"
                                                                    aria-label="Remove item: 'Relaxed'"
                                                                    data-button="">Remove item</button></div>
                                                        </div><input type="text"
                                                            class="choices__input choices__input--cloned"
                                                            autocomplete="off" autocapitalize="off"
                                                            spellcheck="false" role="textbox"
                                                            aria-autocomplete="list" aria-label="false">
                                                    </div>
                                                    <div class="choices__list choices__list--dropdown"
                                                        aria-expanded="false">
                                                        <div class="choices__list" aria-multiselectable="true"
                                                            role="listbox">
                                                            <div id="choices--product-tags-item-choice-3"
                                                                class="choices__item choices__item--choice choices__item--selectable is-highlighted"
                                                                role="option" data-choice="" data-id="3"
                                                                data-value="Solid"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="" aria-selected="true">Solid
                                                            </div>
                                                            <div id="choices--product-tags-item-choice-4"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="4"
                                                                data-value="Washed"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Washed</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <label for="product-status-add1"
                                                    class="form-label">Availability</label>
                                                <div class="choices" data-type="select-one" tabindex="0"
                                                    role="combobox" aria-autocomplete="list" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <div class="choices__inner"><select
                                                            class="form-control choices__input" data-trigger=""
                                                            name="product-status-add1" id="product-status-add1"
                                                            hidden="" tabindex="-1" data-choice="active">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <div class="choices__list choices__list--single">
                                                            <div class="choices__item choices__placeholder choices__item--selectable"
                                                                data-item="" data-id="1" data-value=""
                                                                data-custom-properties="null" aria-selected="true">
                                                                Select</div>
                                                        </div>
                                                    </div>
                                                    <div class="choices__list choices__list--dropdown"
                                                        aria-expanded="false"><input type="text"
                                                            class="choices__input choices__input--cloned"
                                                            autocomplete="off" autocapitalize="off"
                                                            spellcheck="false" role="textbox"
                                                            aria-autocomplete="list" aria-label="Select"
                                                            placeholder="Search">
                                                        <div class="choices__list" role="listbox">
                                                            <div id="choices--product-status-add1-item-choice-3"
                                                                class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted"
                                                                role="option" data-choice="" data-id="3"
                                                                data-value="" data-select-text="Press to select"
                                                                data-choice-selectable="" aria-selected="true">
                                                                Select</div>
                                                            <div id="choices--product-status-add1-item-choice-1"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="1"
                                                                data-value="In Stock"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">In Stock</div>
                                                            <div id="choices--product-status-add1-item-choice-2"
                                                                class="choices__item choices__item--choice choices__item--selectable"
                                                                role="option" data-choice="" data-id="2"
                                                                data-value="Out Of Stock"
                                                                data-select-text="Press to select"
                                                                data-choice-selectable="">Out Of Stock</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                        <button class="btn btn-primary-light m-1">Add Product<i
                                class="bi bi-plus-lg ms-2"></i></button>
                        <button class="btn btn-success-light m-1">Save Product<i
                                class="bi bi-download ms-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

</div>
@endsection    
