document.addEventListener('DOMContentLoaded', function () {
	// Вкладки
	document.querySelectorAll('.tab-btn').forEach(btn => {
		btn.addEventListener('click', () => {
			document
				.querySelectorAll('.tab-btn')
				.forEach(b => b.classList.remove('active'));
			btn.classList.add('active');
			const id = btn.dataset.tab;
			document.querySelectorAll('.tab-content').forEach(content => {
				content.classList.toggle('active', content.id === id);
			});
		});
	});

	// Копировать
	document.querySelectorAll('.copy-btn').forEach(btn => {
		btn.addEventListener('click', () => {
			const codeBlock = btn.closest('.tab-content').querySelector('code');
			const text = codeBlock.textContent;
			navigator.clipboard.writeText(text).then(() => {
				btn.textContent = '✓ Скопировано';
				setTimeout(() => (btn.textContent = '📋 Копировать'), 1500);
			});
		});
	});

	// Кнопка избранного
	const favBtn = document.getElementById('fav-btn');
	if (favBtn) {
		favBtn.addEventListener('click', function () {
			const snippetId = favBtn.dataset.id;
			favBtn.disabled = true;
			fetch('/handlers/toggle_fav.php', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify({ id: snippetId }),
			})
				.then(response => response.json())
				.then(data => {
					if (data.status === 'added') {
						favBtn.classList.add('fav');
						favBtn.textContent = '💖 В избранном';
					} else if (data.status === 'removed') {
						favBtn.classList.remove('fav');
						favBtn.textContent = '🤍 В избранное';
					} else if (data.error) {
						alert('Ошибка: ' + data.error);
					}
				})
				.catch(() => {
					alert('Ошибка соединения с сервером');
				})
				.finally(() => {
					favBtn.disabled = false;
				});
		});
	}

	// Iframe для превью сниппета (если есть)
	const iframe = document.getElementById('snippet-frame');
	if (iframe && window.snippetPreviewData) {
		const doc = iframe.contentDocument || iframe.contentWindow.document;
		doc.open();
		doc.write(`
			<!DOCTYPE html>
			<html>
			<head>
				<style>${window.snippetPreviewData.css}</style>
			</head>
			<body>
				${window.snippetPreviewData.html}
				<script>${window.snippetPreviewData.js}<\/script>
			</body>
			</html>
		`);
		doc.close();
	}
});
