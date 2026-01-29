let s = new String('abcd');
console.log(s);

let s1 = 'gfg';
let s2 = `You are learning from ${s1}`;
console.log(s2);

let s3 = `
    This is a
    multiline
    string`;
console.log(s3);

let sLen = "vishv";
console.log("length: " + sLen.length);

let sChar = "hello";
console.log("charAt: " + sChar.charAt(1));

let scon1 = "vishv ";
let scon2 = "soni";
console.log("concat: " + scon1.concat(scon2));

const sEsc1 = "\'vishv\' is a student";
const sEsc2 = "\"vishv\" is a student";
const sEsc3 = "\\vishv\\ is a student";
console.log(sEsc1);
console.log(sEsc2);
console.log(sEsc3);

let sSubstring = "Hello, welcome to the world of JavaScript";
console.log("substring: " + sSubstring.substring(7, 14));

let sSlice = "Hello, welcome to the world of JavaScript";
console.log("slice: " + sSlice.slice(7, 14));

let sReplace = "Hello World";
console.log("replace: " + sReplace.replace("World", "JavaScript"));
let sReplaceAll = "Hello World Wo   rld";
console.log("replace: " + sReplaceAll.replaceAll("World", "JavaScript"));

let sUpper = "hello";
console.log("toUpperCase: " + sUpper.toUpperCase());

let sLower = "HELLO";
console.log("toLowerCase: " + sLower.toLowerCase());

let sSplit = "apple,banana,cherry";
let fruits = sSplit.split(",");
console.log("split: ", fruits);

let sTrim = "   Hello World!   ";
console.log("trim: '" + sTrim.trim() + "'");

let sIndexOf = "Hello, welcome to the world of JavaScript";
console.log("indexOf: " + sIndexOf.indexOf("welcome"));

let sSubstr = "Hello, welcome to the world of JavaScript";
console.log("substr: " + sSubstr.substr(7, 7));

let sIncludes = "Hello, welcome to the world of JavaScript";
console.log("includes: " + sIncludes.includes("world"));

let sStartsWith = "Hello, welcome to the world of JavaScript";
console.log("startsWith: " + sStartsWith.startsWith("Hello"));

let sEndsWith = "Hello, welcome to the world of JavaScript";
console.log("endsWith: " + sEndsWith.endsWith("JavaScript"));

let sCharCode = "ABC";
console.log("charCodeAt: " + sCharCode.charCodeAt(1));

let sRepeat = "ha";
console.log("repeat: " + sRepeat.repeat(3));

let sSearch = "Hello, welcome to the world of JavaScript";
console.log("search: " + sSearch.search("world"));
