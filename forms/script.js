// Event Listner para as teclas do teclado funcionarem com a calculadora.
document.addEventListener('keydown', function(event) {
    // Mapeia as teclas do teclado para os botões da calculadora.
    const key = event.key;

    // Seleciona os botões com base no valor.
    let button = null;

    // Números ou ponto.
    if (!isNaN(key)) {
        button = document.querySelector(`input[value="${key}"]`);
    } else if (key === ".") {
        button = document.querySelector('input[value="."]');
    }

    // Operações da calculadora.
    switch (key) {
        case "+":
            button = document.querySelector(`input[value="${key}"]`);
            break;
        case "-":
            button = document.querySelector(`input[value="${key}"]`);
            break;
        case "*":
            button = document.querySelector('input[value="x"]');
            break;
        case "/":
            button = document.querySelector('input[value="÷"]');
            break;
        case "%":
            button = document.querySelector('input[value="%"]');
            break;
        case "Enter":
            button = document.querySelector('input[value="="]');
            break;
        case "Backspace":
            button = document.querySelector('input[value="AC"]');
            break;
    }

    // Realiza o clique no botão correspondente.
    if (button) {
        button.click();
    }

});
