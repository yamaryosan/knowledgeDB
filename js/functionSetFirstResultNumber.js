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

// ページの一番上の番号を保存
function setFirstResultNumber() {
  const firstResultNumber = getFirstResultNumberFromQuery();
  sessionStorage.setItem(
    "storage",
    JSON.stringify({ firstResultNumber: firstResultNumber })
  );
}

export default setFirstResultNumber;
