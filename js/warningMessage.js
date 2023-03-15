const messageSentence = "表示数が多いですが、そのまま表示しますか？";
const confirmBool = confirm(messageSentence);
if (confirmBool === true) {
  location.href = "previewPage.php";
} else {
  location.href = "searchPage.php";
}
