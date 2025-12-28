(function () {
  const modal = document.getElementById('adminDetailModal');
  if (!modal) return;

  const genderText = (v) => {
    if (String(v) === '1') return '男性';
    if (String(v) === '2') return '女性';
    return 'その他';
  };

  const open = () => {
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('is-modal-open');
  };

  const close = () => {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('is-modal-open');
  };

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.js-open-detail');
    if (!btn) return;

    // 値セット（XSS対策：textContent）
    document.getElementById('m_name').textContent = btn.dataset.name || '';
    document.getElementById('m_gender').textContent = genderText(btn.dataset.gender);
    document.getElementById('m_email').textContent = btn.dataset.email || '';
    document.getElementById('m_tel').textContent = btn.dataset.tel || '';
    document.getElementById('m_address').textContent = btn.dataset.address || '';
    document.getElementById('m_building').textContent = btn.dataset.building || '';
    document.getElementById('m_category').textContent = btn.dataset.category || '';
    document.getElementById('m_detail').textContent = btn.dataset.detail || '';

    // 削除フォーム action をセット（DELETEルートがある前提）
    const deleteForm = document.getElementById('m_delete_form');
    if (deleteForm) {
      deleteForm.action = `/admin/contacts/${btn.dataset.id}`;
    }

    open();
  });

  // 閉じる（× / 背景）
  modal.addEventListener('click', (e) => {
    if (e.target.closest('.js-close-detail')) {
      close();
    }
  });

  // ESCで閉じる
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('is-open')) {
      close();
    }
  });
})();
