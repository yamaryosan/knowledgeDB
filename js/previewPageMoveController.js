import getDisplayNumber from "./functionGetDisplayNumber.js";
import setFirstResultNumber from "./functionSetFirstResultNumber.js";
import getFirstResultNumber from "./functionGetFirstResultNumber.js";
import getCurrentPageNumberKey from "./functionGetPageNumber.js";

// 現在のURLを取得
function getPreviewPageURL() {
  const pageURL = window.location.href;
  return pageURL;
}

// displayNumberに関するクエリ文字列を消去
function removeDisplayNumberKey(pageURL) {
  const pageURLKeyRemoved = pageURL.replace(
    /&display_number=\d+/g,
    "&display_number=removed"
  );
  return pageURLKeyRemoved;
}

// pageに関するクエリ文字列を消去
function removePageNumberKey(pageURL) {
  const pageURLKeyRemoved = pageURL.replace(/&page=\d+/g, "&page=removed");
  return pageURLKeyRemoved;
}

// ドロップダウンを探索
function findDropdown() {
  const dropdown = document.querySelector("#display_number");
  return dropdown;
}

// URLにdisplayNumberに関するクエリ文字列を付加
function addDisplayNumberKey(dropdown, displayNumber, pageURL) {
  if (dropdown === null) {
    exit;
  } else {
    const link = pageURL.replace(
      "&display_number=removed",
      `&display_number=${displayNumber}`
    );
    return link;
  }
}

// URLにpageに関するクエリ文字列を付加
function addPageNumberKey(dropdown, pageNumber, pageURL) {
  if (dropdown === null) {
    exit;
  } else {
    const link = pageURL.replace("&page=removed", `&page=${pageNumber}`);
    return link;
  }
}

// クエリ文字列から値を取得
function getParam(paramString) {
  const urlParams = new URLSearchParams(window.location.search);
  const paramValue = urlParams.get(paramString);
  return paramValue;
}

// selectedを変更
function changeSelected(dropdown) {
  const displayNumber = getParam("display_number");
  for (const option of dropdown.options) {
    if (option.value === displayNumber) {
      option.selected = true;
      break;
    }
  }
}

// 遷移すべきページを、遷移元ページの先頭の項目番号と遷移先ページの表示数から計算
function calculateNextPageNumber(
  previousFirstResultNumber,
  currentDisplayNumber
) {
  let tempFirstResultNumber = previousFirstResultNumber;
  let tempPageNumber = 1;
  // 項目番号からページ表示数を引いていって計算
  // previousFirstResultNumber = 72, currentDisplayNumber = 25のときは
  // 72 - 25, 47 - 25, 22 - 25で3ページ目があたる
  while (tempFirstResultNumber - currentDisplayNumber >= 1) {
    tempFirstResultNumber -= currentDisplayNumber;
    tempPageNumber++;
  }
  const nextPageNumber = tempPageNumber;
  return nextPageNumber;
}

// セッションストレージをクリア
function removeSessionStorage() {
  sessionStorage.removeItem("storage");
}

// 遷移
function move(pageURL) {
  const moveURL = pageURL;
  window.location.href = moveURL;
}

// 発動するイベント
function event(dropdown) {
  // このJSファイルがあるページのURLを取得
  const pageURL = getPreviewPageURL();

  // 現在の表示数を取得
  const currentDisplayNumber = getDisplayNumber();

  // 遷移元ページの最初の項目の番号を取得
  const previousFirstResultNumber = getFirstResultNumber();

  // 表示数keyの部分をURLから消去
  const pageURLDisplayNumberKeyRemoved = removeDisplayNumberKey(pageURL);

  // 表示数keyをURLに付加
  const pageURLDisplayNumberAdded = addDisplayNumberKey(
    dropdown,
    currentDisplayNumber,
    pageURLDisplayNumberKeyRemoved
  );

  // 遷移先のページ番号を計算
  const nextPageNumber = calculateNextPageNumber(
    previousFirstResultNumber,
    currentDisplayNumber
  );

  // ページ番号keyをURLから消去
  const pageURLPageNumberRemoved = removePageNumberKey(
    pageURLDisplayNumberAdded
  );

  // 現在のページ番号を取得
  // const currentPageNumber = getCurrentPageNumberKey(pageURLDisplayNumberAdded);

  // ページ番号keyをURLに付加
  const pageURLPageNumberAdded = addPageNumberKey(
    dropdown,
    nextPageNumber,
    pageURLPageNumberRemoved
  );
  // 最初の項目の番号を次の遷移に備えて保存
  setFirstResultNumber();

  // 遷移
  move(pageURLPageNumberAdded);
}

// previewPageの遷移をコントロールする関数
function previewPageControl() {
  // 表示数ドロップダウン部を探索
  const dropdown = findDropdown();
  try {
    if (dropdown === null) {
      throw "ドロップダウンなし";
    }
  } catch (e) {
    console.error(e);
    return "";
  }

  // ストレージをクリア
  removeSessionStorage();

  dropdown.addEventListener("change", event);
  dropdown.addEventListener("popstate", event);

  // URLのkeyに合わせてプルダウン中のselectedを定める
  // 遷移先のページで変更が反映される必要がある
  changeSelected(dropdown);
}

previewPageControl();
