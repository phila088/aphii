import * as React from "react";

function IconFileLike({
                          size = 24,
                          color = "currentColor",
                          stroke = 2,
                          ...props
                      }) {
    return <svg xmlns="http://www.w3.org/2000/svg" className="icon icon-tabler icon-tabler-file-like" width={size}
                height={size} viewBox="0 0 24 24" strokeWidth={stroke} stroke={color} fill="none" strokeLinecap="round"
                strokeLinejoin="round" {...props}>
        <desc>{"Download more icon variants from https://tabler-icons.io/i/file-like"}</desc>
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <rect x={3} y={16} width={3} height={5} rx={1}/>
        <path
            d="M6 20a1 1 0 0 0 1 1h3.756a1 1 0 0 0 .958 -.713l1.2 -3c.09 -.303 .133 -.63 -.056 -.884c-.188 -.254 -.542 -.403 -.858 -.403h-2v-2.467a1.1 1.1 0 0 0 -2.015 -.61l-1.985 3.077v4z"/>
        <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
        <path d="M5 12.1v-7.1a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-2.3"/>
    </svg>;
}

export default IconFileLike;
