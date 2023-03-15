// クエリ文字列から現在のページ数を取得
function getCurrentPageNumberKey(pageURL) {
  const pageNumberQuery = pageURL.match(/&page=\d+/g)[0];
  const pageNumber = pageNumberQuery.replace("&page=", "");
  return pageNumber;
}

export default getCurrentPageNumberKey;
