function translasi(ttk_lama, T){
    var x_baru = ttk_lama.x + T.x;
    var y_baru = ttk_lama.y + T.y;

    return {x:x_baru, y:y_baru};
}

function penskalaan(ttk_lama, S){
    var x_baru = ttk_lama.x * S.x;
    var y_baru = ttk_lama.y * S.y;

    return {x:x_baru, y:y_baru};
}

function rotasi(ttk_lama, sudut){
    var x_baru = ttk_lama.x * Math.cos(sudut) - ttk_lama.y * Math.sin(sudut);
    var y_baru = ttk_lama.x * Math.sin(sudut) + ttk_lama.y * Math.cos(sudut);

    return {x:x_baru, y:y_baru};
}

function rotasi_fp(ttk_lama, ttk_putar, sudut){
    var p1 = translasi(ttk_lama, {x : -ttk_putar.x, y : -ttk_putar.y});
    var p2 = rotasi(p1, sudut);
    var p3 = translasi(p2, ttk_putar);

    return p3;
}

function skala_fp(ttk_lama, ttk_putar, S){
    var p1 = translasi(ttk_lama, {x : -ttk_putar.x, y : -ttk_putar.y});
    var p2 = penskalaan(p1, S);
    var p3 = translasi(p2, ttk_putar);

    return p3;
}

function translasi_array(array_ttk, T){
    var array_hasil = [];
    for (var i = 0; i < array_ttk.length; i++){
        var temp = translasi(array_ttk[i], T);
        array_hasil.push(temp);
    }
    return array_hasil;
}

function rotasi_array(array_ttk, ttk_pusat, sudut){
    var array_hasil = [];
    for (var i = 0; i < array_ttk.length; i++){
        var temp = rotasi_fp(array_ttk[i], ttk_pusat, sudut);
        array_hasil.push(temp);
    }
    return array_hasil;
}

function skala_array(array_ttk, ttk_pusat, S){
    var array_hasil = [];
    for (var i = 0; i < array_ttk.length; i++){
        var temp = skala_fp(array_ttk[i], ttk_pusat, S);
        array_hasil.push(temp);
    }
    return array_hasil;
}