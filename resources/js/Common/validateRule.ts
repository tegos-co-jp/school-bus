import { defineRule, configure } from 'vee-validate';
import AllRules from '@vee-validate/rules';
import { localize } from '@vee-validate/i18n';
import * as ja from '@vee-validate/i18n/dist/locale/ja.json';

export default function validateFunction() {
  Object.keys(AllRules).forEach(rule => {
    defineRule(rule, AllRules[rule]);
  });
  localize({ ja });

  configure({
    generateMessage: localize('ja', {
      messages: {
      },
    }),
  });
};

