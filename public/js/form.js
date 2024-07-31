// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.querySelector('form');
//     form.addEventListener('keypress', function(event) {
//         if (event.key === 'Enter') {
//             event.preventDefault();
//         }
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input');

    inputs.forEach((input, index) => {
        input.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const nextInput = inputs[index + 1];
                if (nextInput) {
                    nextInput.focus();
                } else {
                    form.querySelector('button').focus();
                }
            }
        });
    });
});