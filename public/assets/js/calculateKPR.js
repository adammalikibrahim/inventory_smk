const numberWithCommas = (x) => {
    var parts = x.toString().split(",");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return parts.join(",");
}

function calculateKPR() {
    let hargaProperti = document.getElementById('hargaProperti').value;
    let uangMuka = document.getElementById('uangMuka').value;
    let sukuBunga = document.getElementById('angsuran').value;
    let tenor = document.getElementById('tenor').value;

    // Cek batasan minimal harga properti dan uang muka
    if (hargaProperti < 100000000) {
        document.getElementById('errorHargaProperti').innerText = "Harga properti minimal 100 juta";
        document.getElementById('hargaProperti').classList.add('is-invalid');
    } else {
        document.getElementById('errorHargaProperti').innerText = "";
        document.getElementById('hargaProperti').classList.remove('is-invalid');
    }
    if (uangMuka < 50000000) {
        document.getElementById('errorUangMuka').innerText = "Uang muka minimal 50 juta";
        document.getElementById('uangMuka').classList.remove('is-invalid');
    } else {
        document.getElementById('errorUangMuka').innerText = "";
        document.getElementById('uangMuka').classList.remove('is-invalid');
    }

    let jumlahKredit = hargaProperti - uangMuka;

    let tenorBulan = tenor * 12;
    let bungaBulan = sukuBunga / 100 / 12;

    // Hitung angsuran bulanan
    let angsuranBulanan =
        (jumlahKredit * bungaBulan) /
        (1 - Math.pow(1 + bungaBulan, -tenorBulan));

    // document.getElementById('total').innerText = formatRupiah(angsuranBulanan);
    document.getElementById('total').innerText = "Rp. " + numberWithCommas(Math.round(angsuranBulanan));
    document.getElementById('jumlahKredit').innerText = "Rp. " + numberWithCommas(Math.round(jumlahKredit));
    document.getElementById('sukuBunga').innerText = sukuBunga + "%";
}
