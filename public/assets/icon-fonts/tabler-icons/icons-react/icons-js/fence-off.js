import * as React from "react";

function IconFenceOff({
  size = 24,
  color = "currentColor",
  stroke = 2,
  ...props
}) {
  return <svg xmlns="http://www.w3.org/2000/svg" className="icon icon-tabler icon-tabler-fence-off" width={size} height={size} viewBox="0 0 24 24" strokeWidth={stroke} stroke={color} fill="none" strokeLinecap="round" strokeLinejoin="round" {...props}><desc>{"Download more icon variants from https://tabler-icons.io/i/fence-off"}</desc><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 12h-8v4h12m4 0v-4h-4" /><path d="M6 16v4h4v-4" /><path d="M10 12v-2m0 -4l-2 -2m-2 2v6" /><path d="M14 16v4h4v-2" /><path d="M18 12v-6l-2 -2l-2 2v4" /><path d="M3 3l18 18" /></svg>;
}

export default IconFenceOff;