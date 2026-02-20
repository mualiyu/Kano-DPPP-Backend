/**
 * Currency / number format for inputs (e.g. 1,000,000.00)
 * Use class js-currency-input on amount inputs. Optional: data-decimals="0" for integers.
 */
(function () {
  function stripCommas(str) {
    return String(str || '').replace(/,/g, '');
  }

  function formatNumber(num, decimals) {
    if (num === '' || num === null || isNaN(num)) return '';
    var n = parseFloat(num);
    if (isNaN(n)) return '';
    var fixed = n.toFixed(decimals);
    var parts = fixed.split('.');
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    return parts.length > 1 ? parts.join('.') : parts[0];
  }

  function onBlur(e) {
    var el = e.target;
    if (!el.classList.contains('js-currency-input')) return;
    var decimals = parseInt(el.getAttribute('data-decimals'), 10);
    if (isNaN(decimals)) decimals = 2;
    var raw = stripCommas(el.value);
    if (raw === '') return;
    var formatted = formatNumber(raw, decimals);
    if (formatted !== '') el.value = formatted;
  }

  function onFormSubmit(form) {
    form.querySelectorAll('.js-currency-input').forEach(function (el) {
      el.value = stripCommas(el.value);
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.js-currency-input').forEach(function (el) {
      el.addEventListener('blur', onBlur);
      var form = el.closest('form');
      if (form && !form.dataset.currencyFormatDone) {
        form.dataset.currencyFormatDone = '1';
        form.addEventListener('submit', function () {
          onFormSubmit(form);
        });
      }
    });
  });
})();
