import * as React from "react";

function IconFiles({
                       size = 24,
                       color = "currentColor",
                       stroke = 2,
                       ...props
                   }) {
    return <svg xmlns="http://www.w3.org/2000/svg" className="icon icon-tabler icon-tabler-files" width={size}
                height={size} viewBox="0 0 24 24" strokeWidth={stroke} stroke={color} fill="none" strokeLinecap="round"
                strokeLinejoin="round" {...props}>
        <desc>{"Download more icon variants from https://tabler-icons.io/i/files"}</desc>
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M15 3v4a1 1 0 0 0 1 1h4"/>
        <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z"/>
        <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2"/>
    </svg>;
}

export default IconFiles;
