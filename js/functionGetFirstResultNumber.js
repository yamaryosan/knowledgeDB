// 数字だけを取得する
function splitOnlyNumber(textAll) {
  const number = parseInt(textAll.match(/\d+/g));
  try {
    if (number === null) {
      throw new TypeError("nullが代入されています");
    }
    return number;
  } catch (e) {
    console.error(e);
  }
}

// ページの一番上の項目の番号を取得
function getFirstResultNumberFromQuery() {
  const firstUnitA = document.querySelector(".unit_container .count a");
  const text = firstUnitA.text;
  const firstResultNumber = splitOnlyNumber(text);
  return firstResultNumber;
}

// 現在のページの一番上の取得
function getCurrentFirstResultNumber() {
  return getFirstResultNumberFromQuery();
}

// 遷移元のページの一番上の番号を取得
function getPreviousFirstResultNumber() {
  const data = JSON.parse(sessionStorage.getItem("storage"));
  if (data === null) {
    return getCurrentFirstResultNumber();
  } else {
    return data.firstResultNumber;
  }
}

export default getPreviousFirstResultNumber;
