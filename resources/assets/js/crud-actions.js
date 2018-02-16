(function(window, document, $) {
    'use strict';

    $('.remove-action').on('click', function() {
        return confirm('Deseja realmente deletar esse aluno?');
    });

})(window, document, jQuery);