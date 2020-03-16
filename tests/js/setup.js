require('jsdom-global')();
const assert = require('assert')

const Vue = require('vue')
const VueTestUtils = require('@vue/test-utils')
window.Date = Date;