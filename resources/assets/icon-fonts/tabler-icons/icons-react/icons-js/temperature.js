import * as React from "react";

function IconTemperature({
                             size = 24,
                             color = "currentColor",
                             stroke = 2,
                             ...props
                         }) {
    return <svg xmlns="http://www.w3.org/2000/svg" className="icon icon-tabler icon-tabler-temperature" width={size}
                height={size} viewBox="0 0 24 24" strokeWidth={stroke} stroke={color} fill="none" strokeLinecap="round"
                strokeLinejoin="round" {...props}>
        <desc>{"Download more icon variants from https://tabler-icons.io/i/temperature"}</desc>
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M10 13.5a4 4 0 1 0 4 0v-8.5a2 2 0 0 0 -4 0v8.5"/>
        <line x1={10} y1={9} x2={14} y2={9}/>
    </svg>;
}

export default IconTemperature;