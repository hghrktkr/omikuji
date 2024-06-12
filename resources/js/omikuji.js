document.addEventListener('DOMContentLoaded', function() {

  // png取得
  const pngImages = document.querySelectorAll('.png_image');

  // 結果表示用ドキュメント
  const resultText = document.getElementById('result_text');
  const explanation = document.getElementById('explanation');
  const rankName = resultText.dataset.rank;

  // 結果表示用コンテナ
  const resultContainer = document.querySelector('.result');

  // 音声関係
  const drum = document.getElementById('drum');
  const lvup = document.getElementById('lvup');

  // pngをクリックした時の動作
  pngImages.forEach(image => {
    image.addEventListener('click', function(){
      // pngを非表示にする
      pngImages.forEach(i => i.classList.add('hidden'));
      explanation.classList.add('hidden');

      // クリックしたpngだけ表示
      this.classList.remove('hidden');
      this.classList.add('selected');

      // 音声再生
      drum.play();

      // 設定時間後にselectedも非表示にし、テキストを表示する
      setTimeout(() => {
        this.classList.add('hidden');
        lvup.play();
        resultText.innerText = rankName + '賞です！';
        resultContainer.classList.remove('hidden');
      }, 4000); // 4000ミリ秒後
    });
  });
});