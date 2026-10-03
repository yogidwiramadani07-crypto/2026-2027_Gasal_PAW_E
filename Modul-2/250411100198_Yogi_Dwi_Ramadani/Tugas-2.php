<?php
// Tugas Praktikum
// 1.) If, elseif, else & For
// Kerjakan soal berikut menggunakan If, elseif, else & For dengan ketentuan berikut:
// Array $matkul memiliki value “PTI”,“ALPRO”,“DPW”,“STRUKDAT”,“JARKOM”,“PAW”,“PSBF”,“RPL”
// Array$praktikummemilikivalue“JARKOM”
// ,
// “PAW”
// didalamforlakukanpengecekanmenggunakanif
// Jikadata$matkuldan$praktikumsama,makatampilkan“Sayasedang
// mengambil matkul (nama matkul sesuaikan) termasuk praktikumnya”
// Jika data $matkul indeks 6 atau 7, maka tampilkan “Saya belum
// mengambil matkul (nama matkul sesuaikan)”
// Jikatidakmemenuhikondisimanapun,makatampilkan“Sayasudah
// mengambil matkul (nama matkul sesuaikan) semester lalu”


$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW"];

for ($i = 0; $i < count($matkul); $i++) {

    if ($matkul[$i] == $praktikum[0] || $matkul[$i] == $praktikum[1]) {
        echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikumnya<br>";
    }
    elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul " . $matkul[$i] . "<br>";
    }
    else {
        echo "Saya sudah mengambil matkul " . $matkul[$i] . " semester lalu<br>";
    }

}
echo "<br>";



//2.) Foreach & Switch
//Kerjakan soal berikut menggunakan Foreach dan Switch dengan ketentuanberikut:
// array $matkul memiliki value “PTI”,“ALPRO”,“DPW”,“STRUKDAT”,“JARKOM”,“PAW”,“PSBF”,“RPL”
// didalamforeachlakukanpengecekanmenggunakanswitch
// jikacase“PTI”makatampilkan“SayasukaPTI”
// jikacase“ALPRO”makatampilkan“SayasukaALPRO”
// jikacase“DPW”makatampilkan“SayasukaDPW”
// jikacase“STRUKDAT”makatampilkan“SayasukaSTRUKDAT”
// jikacase“JARKOM”makatampilkan“SayasukaJARKOM”
// jikacase“PAW”makatampilkan“SayasukaPAW”
// defaultakanmenampilkan“Sayatidakmengambilmatkul(namamatkul
// menyesuaikan saat foreach)”
// hint:argumenmenggunakanparameteralias
// hint:parameteraliasdapatdigunakanuntukmenampilkanhasilsetiap
// case


$matkul = [
    "PTI", "ALPRO", "DPW", "STRUKDAT",
    "JARKOM", "PAW", "PSBF", "RPL"
];

foreach ($matkul as &$nama) {
    switch ($nama) {
        case "PTI":
            echo "Saya suka PTI<br>";
            break;

        case "ALPRO":
            echo "Saya suka ALPRO<br>";
            break;

        case "DPW":
            echo "Saya suka DPW<br>";
            break;

        case "STRUKDAT":
            echo "Saya suka STRUKDAT<br>";
            break;

        case "JARKOM":
            echo "Saya suka JARKOM<br>";
            break;

        case "PAW":
            echo "Saya suka PAW<br>";
            break;

        default:
            echo "Saya tidak mengambil matkul "
                . $nama . "<br>";
    }
}

unset($nama);

echo "<br>";



// 3.) Do While
// Kerjakan soal berikut menggunakan Do While dengan ketentuan berikut:
// $angkadimulaidari0
// Tampilkan$angkakelipatan4sampaimenyentuhnilai20


$angka = 0;

do {
    echo $angka . "<br>";
    $angka += 4;
} while ($angka <= 20);


?>
