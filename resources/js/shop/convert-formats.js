function megabytesToBytes( mega ) {
    return kilobytesToBytes( 1024 * mega );
}

function kilobytesToBytes( kilo ) {
    return kilo * 1024 ;
}

function bytesToMegabytes( bytes ) {
    return bytesToKilobytes( bytes )/1024;
}

function bytesToKilobytes( bytes ) {
    return bytes/1024;
}

export { megabytesToBytes, bytesToMegabytes };
