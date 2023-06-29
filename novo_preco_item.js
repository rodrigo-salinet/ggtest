function formatarReal(obj) {
    let txt_preco = obj.value;
    let txt_preco_final = txt_preco.replace(/\D/g, "");

    if (isNaN(parseInt(txt_preco_final))) {
        txt_preco_final = '0';
    }

    txt_preco_final = String(parseInt(txt_preco_final));

    if (txt_preco_final == '0') {
        txt_preco_final = '';
    }

    switch (txt_preco_final.length) {
        case 0:
            obj.value = '';
            break;
        case 1:
            obj.value = '0,0' + txt_preco_final;
            break;
        case 2:
            obj.value = '0,' + txt_preco_final;
            break;
        case 3:
            obj.value = txt_preco_final.charAt(0) + ',' + txt_preco_final.charAt(1) + txt_preco_final.charAt(2);
            break;
        case 4:
            obj.value = txt_preco_final.charAt(0) + txt_preco_final.charAt(1) + ',' + txt_preco_final.charAt(2) + txt_preco_final.charAt(3);
            break;
        case 5:
            obj.value = txt_preco_final.charAt(0) + txt_preco_final.charAt(1) + txt_preco_final.charAt(2) + ',' + txt_preco_final.charAt(3) + txt_preco_final.charAt(4);
            break;
        case 6:
            obj.value = txt_preco_final.charAt(0) + '.' + txt_preco_final.charAt(1) + txt_preco_final.charAt(2) + txt_preco_final.charAt(3) + ',' + txt_preco_final.charAt(4) + txt_preco_final.charAt(5);
            break;
        case 7:
            obj.value = txt_preco_final.charAt(0) + txt_preco_final.charAt(1) + '.' + txt_preco_final.charAt(2) + txt_preco_final.charAt(3) + txt_preco_final.charAt(4) + ',' + txt_preco_final.charAt(5) + txt_preco_final.charAt(6);
            break;
        case 8:
            obj.value = txt_preco_final.charAt(0) + txt_preco_final.charAt(1) + txt_preco_final.charAt(2) + '.' + txt_preco_final.charAt(3) + txt_preco_final.charAt(4) + txt_preco_final.charAt(5) + ',' + txt_preco_final.charAt(6) + txt_preco_final.charAt(7);
            break;
        default:
            obj.value = '';
    }
}