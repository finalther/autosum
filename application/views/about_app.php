<style>
.row {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
}
.row > [class*='col-'] {
  display: flex;
  flex-direction: column;
}
.row .col-md-3 {
  background-image:url("../assets/img/bgku.png");
  background-size:300px 450px;
}
</style>
  <div class="container">
    <h3 style="text-align:center;color:#BDC7C9;">Tentang Sistem</span></h1>
  <div class="row" style="background-color: #FFFFFF;padding:20px;">
    <div class="col-md-3" style="background-color: #646464;">
    </div>
    <div class="col-md-6" style="color:#BDC7C9;">  
        <p style="text-align:justify;">Peringkasan Teks Otomatis adalah Suatu aplikasi web yang dikhusukan untuk menghasilkan sebuah ringkasan dari suatu artikel bacaan. Sistem ini dibangun dengan Machine Learning menggunakan Algoritma K-Nearest Neighbors(k-NN) Dipadukan dengan Ekstraksi Fitur Statistik. Sistem ini merupakan Pengembangan dari sistem sebelumnya yang pernah dibuat dengan data uji statis.</p>
          <p >Berikut merupakan Fitur Statistik yang digunakan : </p>
          <p>1. Posisi kalimat dalam paragraf</p>
          <p>2. Posisi kalimat dalam Keseluruhan Dokumen</p>
          <p>3. Data Numerik dalam kalimat</p>
          <p>4. Double Quote dalam kalimat</p>
          <p>5. Panjang Kalimat dalam sebuah paragraf</p>
          <p>6. Kata Kunci kalimat (diambil dari judul dokumen)</p>
          <p>Ke enam fitur statistik tersebut mengacu pada penelitian yang dilakukan oleh Desai & Shah 2016 yang berjudul <i>Automatic Text Summarization Using Supervised Machine Learning Technique for Hindi Langauge</i> </p>
          <p>Untuk Lebih detail mengenai Cara kinerja sistem serta pengujian dan akurasi sistem dapat dilihat pada jurnal berikut:</p>
          <p>Link : <a href="http://j-ptiik.ub.ac.id/index.php/j-ptiik/article/view/433" target="blank">http://j-ptiik.ub.ac.id/index.php/j-ptiik/article/view/433</a></p>
    </div>
  </div>
