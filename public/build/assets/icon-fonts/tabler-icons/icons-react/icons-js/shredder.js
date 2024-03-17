import * as React from "react";

function IconShredder({
                          size = 24,
                          color = "currentColor",
                          stroke = 2,
                          ...props
                      }) {
    return <svg xmlns="http://www.w3.org/2000/svg" className="icon icon-tabler icon-tabler-shredder" width={size}
                height={size} viewBox="0 0 24 24" strokeWidth={stroke} stroke={color} fill="none" strokeLinecap="round"
                strokeLinejoin="round" {...props}>
        <desc>{"Download more icon variants from https://tabler-icons.io/i/shredder"}</desc>
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <rect x={4} y={10} width={16} height={5} rx={1}/>
        <path d="M17 10v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4m5 5v5m4 -5v2m-8 -2v3"/>
    </svg>;
}

export default IconShredder;
