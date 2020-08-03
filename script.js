const masks = {
    telefone(value){
        return value
        .replace(/\D/g, '')
        .replace(/(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{5})(\d)/, '$1-$2')
        .replace(/(-\d{4})(\d+?$)/, '$1')
    },

    dinheiro(value){
        return value
        .replace(/\D/g, '')
        .replace(/(\d)(\d{2})/, 'R$ $1,$2')
        .replace(/(\d{1}),(\d)(\d{2})/, '$1$2,$3')
        .replace(/(\d{2}),(\d)(\d{2})/, '$1$2,$3')
        .replace(/(\d{1})(\d{2}),(\d)(\d{2})/, '$1.$2$3,$4')
        .replace(/(\d{1}).(\d{1})(\d{2}),(\d)(\d{2})/, '$1$2.$3$4,$5')
        .replace(/(\d{2}).(\d{1})(\d{2}),(\d)(\d{2})/, '$1$2.$3$4,$5')
        .replace(/(\d{1})(\d{1})(\d{1}).(\d{1})(\d{1})(\d{1}),(\d)(\d{2})/, '$1.$2$3$4.$5$6$7,$8')
        .replace(/(\d{1}).(\d{1})(\d{1})(\d{1}).(\d{1})(\d{1})(\d{1}),(\d)(\d{2})/, '$1$2.$3$4$5.$6$7$8,$9')
        .replace(/(\d{1})(\d{1}).(\d{1})(\d{1})(\d{1}).(\d{1})(\d{1})(\d{1}),(\d)(\d{2})/, '$1$2$3.$4$5$6.$7$8$9,$10')
        .replace(/(\d{1})(\d{1})(\d{1}).(\d{1})(\d{1})(\d{1}).(\d{1})(\d{1})(\d{1}),(\d)(\d{2})/, '$1.$2$3$4.$5$6$7.$8$9$10,$11')
        .replace(/(,\d{2})\d+?$/, '$1') 
    }
}

document.querySelectorAll("input").forEach(($input) => {
    const field = $input.dataset.js
    $input.addEventListener('input', (e) => {
        e.target.value = masks[field](e.target.value)
    }, false)
})


