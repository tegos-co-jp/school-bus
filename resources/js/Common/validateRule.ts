import { defineRule, configure } from 'vee-validate';
import AllRules from '@vee-validate/rules';
import { localize } from '@vee-validate/i18n';
import * as ja from '@vee-validate/i18n/dist/locale/ja.json';

export default function validateFunction() {
  Object.keys(AllRules).forEach(rule => {
    defineRule(rule, AllRules[rule]);
  });
  defineRule('tel', (value, [], ctx) => {
    if (!value || !value.length) {
      return true;
    }
    //-を外して数値のみでチェック
    var custumTel = value.replace(/[━.‐.―.－.-.ー.-]/gi,'');
    if (!custumTel.match(/^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-9]{7})$/)) {
      return false;
    }
    return true;
  });
  
  localize({ ja });

  configure({
    generateMessage: localize('ja', {
      messages: {
      },
    }),
  });
};

