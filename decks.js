const filtros = {
    comandante: document.getElementById('filtro-comandante'),
    standings:  document.getElementById('filtro-standings'),
    posicao:    document.getElementById('filtro-posicao'),
    arquetipo:  document.getElementById('filtro-arquetipo'),
};

const linhas        = document.querySelectorAll('#tabela-body tr');
const contador      = document.getElementById('contador');
const semResultados = document.getElementById('sem-resultados');
const totalLinhas   = linhas.length;

function aplicarFiltros() {
    const vals = {
        comandante: filtros.comandante.value.toLowerCase().trim(),
        standings:  filtros.standings.value.toLowerCase().trim(),
        posicao:    filtros.posicao.value.trim(),
        arquetipo:  filtros.arquetipo.value.toLowerCase(),
    };

    let visiveis = 0;

    linhas.forEach(linha => {
        const bate =
            linha.dataset.comandante.includes(vals.comandante) &&
            linha.dataset.standings.includes(vals.standings) &&
            (vals.posicao   === '' || linha.dataset.posicao   === vals.posicao) &&
            (vals.arquetipo === '' || linha.dataset.arquetipo === vals.arquetipo);

        linha.style.display = bate ? '' : 'none';
        if (bate) visiveis++;
    });

    contador.textContent = `Exibindo ${visiveis} de ${totalLinhas} deck(s)`;
    semResultados.classList.toggle('hidden', visiveis > 0);
}

Object.values(filtros).forEach(el => el.addEventListener('input', aplicarFiltros));

document.getElementById('limpar-filtros').addEventListener('click', () => {
    Object.values(filtros).forEach(el => el.value = '');
    aplicarFiltros();
});

aplicarFiltros();
