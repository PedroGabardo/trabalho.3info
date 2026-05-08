document.querySelector('form').addEventListener('submit', function(e) {
  const campos = [
    { id: 'comandante', label: 'Comandante' },
    { id: 'link',       label: 'Link da Lista' },
    { id: 'standings',  label: 'Standings' },
    { id: 'posicao',    label: 'Posição' },
  ];

  const erros = [];

  campos.forEach(function(campo) {
    const el = document.getElementById(campo.id);
    const vazio = !el.value.trim();
    el.style.borderColor = vazio ? '#f87171' : '';
    if (vazio) erros.push(campo.label);
  });

  const link = document.getElementById('link');
  if (link.value.trim() && !link.value.trim().startsWith('http')) {
    link.style.borderColor = '#f87171';
    erros.push('Link inválido (deve começar com http)');
  }

  const posicao = document.getElementById('posicao');
  if (posicao.value && Number(posicao.value) < 1) {
    posicao.style.borderColor = '#f87171';
    erros.push('Posição deve ser maior que zero');
  }

  const erroEl = document.getElementById('erro-js');
  if (erros.length > 0) {
    e.preventDefault();
    erroEl.style.display = 'block';
    erroEl.textContent = '⚠ Preencha corretamente: ' + erros.join(', ');
  } else {
    erroEl.style.display = 'none';
  }
});