function gbr_titik(imageDataTemp, x, y, r, g, b){
    var index;
    index = 4*(Math.ceil(x)+(Math.ceil(y)*canvasKita.width))
    imageDataTemp.data[index] = r;
    imageDataTemp.data[index+1] = g;
    imageDataTemp.data[index+2] = b;
    imageDataTemp.data[index+3] = 255;
}

function dda_line(imageData, x1, y1, x2, y2, r, g, b){
    var dx = x2-x1;
    var dy = y2-y1;

    if(Math.abs(dx) > Math.abs(dy)){
        //jalan di sumbu x
        if(x2 > x1){
            //jalan ke kanan
            var y = y1;
            for(var x = x1; x<=x2; x++){
                y = y + dy/Math.abs(dx) //1/m
                gbr_titik(imageData, x, y, r, g, b)
            }
        }
        else{
            //jalan ke kiri
            var y = y1;
            for(var x = x1; x>=x2; x--){
                y = y + dy/Math.abs(dx) //1/m
                gbr_titik(imageData, x, y, r, g, b)
            }
        }
    }
    else{
        //jalan di sumbu y
        if(y2 > y1){
            //jalan ke kanan
            var x = x1;
            for(var y = y1; y<=y2; y++){
                x = x + dx/Math.abs(dy) //m
                gbr_titik(imageData, x, y, r, g, b)
            }
        }
        else{
            //jalan ke kiri
            var x = x1;
            for(var y = y1; y>=y2; y--){
                x = x + dx/Math.abs(dy) //m
                gbr_titik(imageData, x, y, r, g, b)
            }
        }
    }
}

function gbr_lingkaran(imageDataTemp, xc, yc, radius, r, g, b){
    //milih dari x atau y
    //jalan dari xc - radius sampai dengan xc + radius
    //tentukan y, dan gambar  x,y
    for (var x = xc-radius; x < xc+radius; x++){
        var y = yc + Math.sqrt(Math.pow(radius,2) - Math.pow((x-xc),2)); //akar dari r2 - (x-xc)2
        gbr_titik(imageDataTemp, x, y, r, g, b);

        var y = yc - Math.sqrt(Math.pow(radius,2) - Math.pow((x-xc),2)); //akar dari r2 - (x-xc)2
        gbr_titik(imageDataTemp, x, y, r, g, b);
    }

    for (var x = xc-radius; x < xc+radius; x++){
        var y = yc + Math.sqrt(Math.pow(radius,2) - Math.pow((x-xc),2)); //akar dari r2 - (x-xc)2
        gbr_titik(imageDataTemp, y, x, r, g, b);

        var y = yc - Math.sqrt(Math.pow(radius,2) - Math.pow((x-xc),2)); //akar dari r2 - (x-xc)2
        gbr_titik(imageDataTemp, y, x, r, g, b);
    }
}

function lingkaran_polar(imageDataTemp, xc, yc, radius, r, g, b){
    for(var theta = 0; theta < Math.PI*2; theta += 0.01){
        x = xc + radius*Math.cos(theta);
        y = yc + radius*Math.sin(theta);

        gbr_titik(imageDataTemp, x, y, r, g, b)
    }
}

function ellipse_polar(imageDataTemp, xc, yc, radiusX, radiusY, r, g, b){
    for(var theta = 0; theta < Math.PI*2; theta += 0.01){
        x = xc + radiusX*Math.cos(theta);
        y = yc + radiusY*Math.sin(theta);

        gbr_titik(imageDataTemp, x, y, r, g, b)
    }
}

function siput(imageDataTemp, xc, yc, r, g, b){
    for(var theta = 0; theta <= Math.PI*6; theta += 0.01){
        x = xc + (5*theta)*Math.cos(theta);
        y = yc + (5*theta)*Math.sin(theta);

        gbr_titik(imageDataTemp, x, y, r, g, b);
    }
}

function ketupat(imageDataTemp, xc, yc, radius, r, g, b){
    for(var theta = 0; theta <= Math.PI*2; theta += 0.01){
        x = xc + radius*Math.cos(10*theta)*Math.cos(theta);
        y = yc + radius*Math.cos(10*theta)*Math.sin(theta);

        gbr_titik(imageDataTemp, x, y, r, g, b);
    }
}

function cardiod(imageDataTemp, xc, yc, radius, r, g, b){
    for(var theta = 0; theta <= Math.PI*2; theta += 0.01){
        x = xc + ((radius + radius * Math.sin(theta)) * Math.cos(theta));
        y = yc + ((radius + radius * Math.sin(theta)) * Math.sin(theta));

        gbr_titik(imageDataTemp, x, y, r, g, b);
    }
}

function clover(imageDataTemp, xc, yc, radius, r, g, b){
    var pi = 0;
    for(var theta = 0; theta <= Math.PI*2; theta += 1/radius){
        x = xc + (radius*Math.cos(2*theta)+10*Math.sin(pi))*Math.cos(theta);
        y = yc + (radius*Math.cos(2*theta)+10*Math.sin(pi))*Math.sin(theta);
        pi += 30 / radius;

        gbr_titik(imageDataTemp, x, y, r, g, b);
    }
}

function floodFillNaive(imageData, canvas, x, y, toFlood, color){
    //cara kerja algoritma floodfill adalah sebagai berikut :
    //pilih titik x, y
    //cek apakah titik tersebut sudah berwarna atau belum 
    //bila belum diwarnai, lalu proses titik tetangganya

    var index = 4 * (x + y * canvas.width)

    var r1 = imageData.data[index];
    var g1 = imageData.data[index+1];
    var b1 = imageData.data[index+2];

    if((r1 == toFlood.r) && (g1 == toFlood.g) && (b1 == toFlood.b)){
        imageData.data[index] = color.r;
        imageData.data[index+1] = color.g;
        imageData.data[index+2] = color.b;
        imageData.data[index+3] = 255;

        floodFillNaive(imageData, canvas, x+1, y, toFlood, color);
        floodFillNaive(imageData, canvas, x, y+1, toFlood, color);
        floodFillNaive(imageData, canvas, x-1, y, toFlood, color);
        floodFillNaive(imageData, canvas, x, y-1, toFlood, color);
    }
}

function floodFillStack(imageData, canvas, x0, y0, toFlood, color){
    var index = 4 * (x0 + y0 * canvas.width)

    var tumpukan = [];
    tumpukan.push({x : x0, y : y0});

    while(tumpukan.length > 0){
        //ambil satu titik dari tumpukan
        //cek titik tersebut bisa diwarna atau engga
        //kalo bisa warna lalu masukkan dalm tumpukan titik sekitarnya

        var titik_sekarang = tumpukan.pop();
        var index_sekarang = 4 * (titik_sekarang.x + titik_sekarang.y * canvas.width);

        var r1 = imageData.data[index_sekarang];
        var g1 = imageData.data[index_sekarang+1];
        var b1 = imageData.data[index_sekarang+2];

        if((r1 == toFlood.r) && (g1 == toFlood.g) && (b1 == toFlood.b)){
            imageData.data[index_sekarang] = color.r;
            imageData.data[index_sekarang+1] = color.g;
            imageData.data[index_sekarang+2] = color.b;
            imageData.data[index_sekarang+3] = 255;

            tumpukan.push({x : titik_sekarang.x+1, y : titik_sekarang.y})
            tumpukan.push({x : titik_sekarang.x-1, y : titik_sekarang.y})
            tumpukan.push({x : titik_sekarang.x, y : titik_sekarang.y+1})
            tumpukan.push({x : titik_sekarang.x, y : titik_sekarang.y-1})
        }
    }
}