<?php
// 1.1
$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

print_r($fruits);

$jumlahdata = count($fruits);
echo "<br>Indeks tertinggi: " . $fruits[$jumlahdata - 1];


1.2
$fruits = array("Avocado", "Blueberry", "Cherry");

echo "Data Blueberry dihapus<br>";
unset($fruits[1]);

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

print_r($fruits);

$jumlahdata = count($fruits);
echo "<br>Indeks tertinggi: " . $fruits[$jumlahdata];


// 2.1
$fruits = array("Avocado", "Blueberry", "Cherry");

$dataBaru = array("Durian", "Elderberry", "Fig", "Grape", "Honeydew");

for ($i = 0; $i < count($dataBaru); $i++) {
    $fruits[] = $dataBaru[$i];
}

$arrlength = count($fruits);

echo "Panjang array: " . $arrlength . "<br>";

echo "<br>";

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}


// 2.2
$vegies = array("Carrot", "Broccoli", "Spinach");

$arrlength = count($vegies);

for ($x = 0; $x < $arrlength; $x++) {
    echo $vegies[$x] . "<br>";
}


// 3.1
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

$height["Diana"] = "168";
$height["Edward"] = "180";
$height["Farah"] = "160";
$height["Gilang"] = "172";
$height["Hana"] = "166";

print_r($height);

echo "<br>Nilai terakhir: " . $height["Hana"] . " cm";

unset($height["Barry"]);

echo "<br><br>Setelah Barry dihapus:<br>";
print_r($height);

echo "<br>Nilai terakhir: " . $height["Hana"] . " cm" . "<br>" . "<br>";

// 3.2
$weight = array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

print_r($weight);

echo "<br>Data Kedua: " . $weight["Barry"];


// 4.1
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

print_r($height);

echo "<br>" . "<br>";

foreach ($height as $nama => $tinggi) {
    echo $nama . " memiliki tinggi " . $tinggi . " cm.<br>";
}


// 4.2
$weight = array(
    "Alex" => 60,
    "Bianca" => 52,
    "Candice" => 55
);

$nama = array("Alex", "Bianca", "Candice");
$berat = array(60, 52, 55);

print_r($weight);

echo "<br>" . "<br>";

for ($i = 0; $i < count($weight); $i++) {
    echo $nama[$i] . " memiliki berat " . $berat[$i] . " kg.<br>";
}


// 5.1
// Data awal
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

echo "Data awal:<br>";
echo "students = (";
echo "<pre>";
print_r($students);
echo "</pre>";

// Menambahkan 5 data mahasiswa
$students[] = array("Daniel", "220404", "0812345611");
$students[] = array("Elena", "220405", "0812345622");
$students[] = array("Fiona", "220406", "0812345633");
$students[] = array("Gabe", "220407", "0812345644");
$students[] = array("Hannah", "220408", "0812345655");

echo "Data setelah ditambah 5 data lain:<br>";
echo "students = (";
echo "<pre>";
print_r($students);
echo "</pre>";

// Menampilkan tabel
echo "<table border='1'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

foreach ($students as $data) {
    echo "<tr>";
    echo "<td>" . $data[0] . "</td>";
    echo "<td>" . $data[1] . "</td>";
    echo "<td>" . $data[2] . "</td>";
    echo "</tr>";
}

echo "</table>";


// 6.1
// array_push()
$buah = array("A");
echo "Array awal: (\"A\")<br>";

array_push($buah, "B");
echo "Hasil array_push: ";
foreach ($buah as $b) {
    echo $b . " ";
}
echo "<br><br>";

// array_merge()
$buah1 = array("A", "B");
$buah2 = array("C");

echo "Array awal: (\"A\", \"B\") digabung dengan (\"C\")<br>";

$gabungan = array_merge($buah1, $buah2);
echo "Hasil array_merge: ";
foreach ($gabungan as $b) {
    echo $b . " ";
}
echo "<br><br>";

// array_values()
$nilai = array("x" => 1, "y" => 2);

echo "Array awal: (\"x\" => 1, \"y\" => 2)<br>";

$hasil = array_values($nilai);
echo "Hasil array_values: ";
foreach ($hasil as $n) {
    echo $n . " ";
}
echo "<br><br>";

// array_search()
$huruf = array("A", "B", "C");

echo "Mencari \"B\" pada array: (\"A\", \"B\", \"C\")<br>";

$cari = array_search("B", $huruf);
echo "Hasil array_search: " . $cari;
echo "<br><br>";

// array_filter()
$angka = array(0, 1, false, 2, "", 3, "array");

echo "Array awal: (0, 1, false, 2, \"\", 3, \"array\")<br>";

$hasil = array_filter($angka);
echo "Hasil array_filter: ";
foreach ($hasil as $n) {
    echo $n . " ";
}
echo "<br><br>";

// sort() dan rsort()
$angka = array(3, 1, 2);

echo "Array awal: (3, 1, 2)<br>";

sort($angka);
echo "Hasil sort: ";
foreach ($angka as $n) {
    echo $n . " ";
}
echo "<br>";

rsort($angka);
echo "Hasil rsort: ";
foreach ($angka as $n) {
    echo $n . " ";
}
echo "<br><br>";

// asort(), ksort(), arsort(), krsort()
$nilai = array("Peter" => 35, "Ben" => 37, "Joe" => 43);

echo "Array awal: (\"Peter\"=>35, \"Ben\"=>37, \"Joe\"=>43)<br>";

asort($nilai);
echo "Hasil asort: ";
foreach ($nilai as $nama => $umur) {
    echo $nama . " => " . $umur . ", ";
}
echo "<br>";

ksort($nilai);
echo "Hasil ksort: ";
foreach ($nilai as $nama => $umur) {
    echo $nama . " => " . $umur . ", ";
}
echo "<br>";

arsort($nilai);
echo "Hasil arsort: ";
foreach ($nilai as $nama => $umur) {
    echo $nama . " => " . $umur . ", ";
}
echo "<br>";

krsort($nilai);
echo "Hasil krsort: ";
foreach ($nilai as $nama => $umur) {
    echo $nama . " => " . $umur . ", ";
}

?>
