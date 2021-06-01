<x-web-layout>

  <div class="flex flex-wrap lg:flex-nowrap w-full max-w-screen-xl mx-auto px-4 py-12 xl:px-12 xl:pt-16 xl:pb-16">
    <div class="flex flex-col w-full lg:pr-4 lg:w-3/5 xl:pr-10">
      <div class="mb-8">
        <h1 class="text-2xl lg:text-3xl text-blue font-display font-bold mb-4">Daily Market</h1>
        <div class="w-full border border-gray-200 py-6 px-4 md:p-8">
          <h3 class="text-lg lg:text-xl text-blue font-display font-bold mb-4">Wed, 27 Mar 2019</h3>
          <div>
            Meski rebound namun kami melihat market belum sepenuhnya pulih, rebound yang terjadi kemarin lebih karena
            bargain hunting sesaat namun tidak dalam jangka panjang. Investor terlihat masih hati-hati dan indeks berada
            di bawah ma5. Beberapa sektor bergerak menguat diantaranya; sektor Industri Dasar (+1.81%), Barang Konsumsi
            (+1.20%), dan Aneka Industri (+0.99%).
          </div>
          <div class="mt-4"><a href="#" class="button button-text button-lg"><span class="mr-1">Continue
                Reading</span> <span class="material-icons">arrow_right_alt</span></a></div>
        </div>
      </div>
      <div class="flex flex-col mb-8 lg:mb-0">
        <h2 class="uppercase text-gray-600 font-bold">PREVIOUS DAILY MARKET</h2>
        <div>
          <div class="w-full border-b border-gray-200 py-4">
            <h3 class="text-xl text-blue font-display font-bold mt-2 mb-4">Tue, 26 Mar 2019</h3>
            <div>
              Market seperti roller coster, baru saja diliputi berita positif dengan Rupiah dan iklim investment grade
              namun kemudian berita perlambatan ekonomi global dan resiko resesi yang membayangi di depan mata membuat
              investor panik dan khawatir. Beberapa sektor bergerak melemah diantaranya; sektor Aneka Industri (-2.46%),
              Barang Konsumsi (-2.77%), dan Properti (-1.75%).
            </div>
            <div class="mt-2"><a href="#" class="button button-text"><span class="mr-1">Continue
                  Reading</span> <span class="material-icons">arrow_right_alt</span></a></div>
          </div>
          <div class="w-full border-b border-gray-200 py-4">
            <h3 class="text-xl text-blue font-display font-bold mt-2 mb-4">Wed, 13 Mar 2019</h3>
            <div>
              Dalam dua hari terakhir indeks masih cukup tertekan, Brexit cukup positif dan iklim trade war yang mulai
              berkurang dapat menjaga stabilitas pasar saham di arah yang lebih kondusif. Namun investor masih khawatir
              dengan pelemahan Rupiah sejauh ini. Beberapa sektor bergerak melemah diantaranya; sektor Industri Dasar
              (-1.13%), Pertambangan (-0.23%), dan Keuangan (-0.40%).
            </div>
            <div class="mt-2"><a href="#" class="button button-text"><span class="mr-1">Continue
                  Reading</span> <span class="material-icons">arrow_right_alt</span></a></div>
          </div>
          <div class="w-full border-b border-gray-200 py-4">
            <h3 class="text-xl text-blue font-display font-bold mt-2 mb-4">Tue, 12 Mar 2019</h3>
            <div>
              Masih minimnya sentimen positif di awal pekan membuat investor tidak memiliki pilihan lain kecuali
              melakukan aksi jual-nya. Namun rupiah yang sedikit stabil mampu menjaga pelemahan indeks ke level yang
              lebih dalam. Pekan ini akan cukup banyak data makro penting akan di rilis dan bisa menjadi sentimen bagi
              investor. Beberapa sektor bergerak melemah diantaranya; sektor Pertanian (-0.73%), Infrastruktur (-0.49%),
              dan Industri Dasar (-1.14%).
            </div>
            <div class="mt-2"><a href="#" class="button button-text"><span class="mr-1">Continue
                  Reading</span> <span class="material-icons">arrow_right_alt</span></a></div>
          </div>
        </div>
        <div>
          <ul class="pagination">
            <li><a href="#">« Previous</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">Next »</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div id="market-news" class="flex flex-col w-full lg:pl-4 lg:w-2/5 xl:pl-16">
      <h2 class="text-3xl text-blue font-display font-bold mb-4">Market News</h2>
      <div class="flex-1 w-full">
        <x-market-news per-page="10" text-size="text-sm" />
      </div>
    </div>
  </div>

</x-web-layout>