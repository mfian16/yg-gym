import './bootstrap';
import $ from 'jquery';

window.$ = window.jQuery = $;

$(function () {
    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 3000);

    $(document).on('submit', 'form.form-delete', function (e) {
        if (!confirm('Yakin ingin menghapus member ini?')) {
            e.preventDefault();
            return false;
        }
    });

    let cropper;

    $('#fotoInput').on('change', function (e) {
        const file = e.target.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            $('#preview')
                .attr('src', event.target.result)
                .show();

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper($('#preview')[0], {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1
            });
        };

        reader.readAsDataURL(file);
    });

    $(document).on('submit', 'form:not(.form-delete)', function () {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });

            $('#fotoCropped').val(canvas.toDataURL('image/jpeg'));
        }
    });
    
    $(document).on('keyup', '.search-table', function () {
        let keyword = $(this).val().toLowerCase();
        let targetTable = $(this).data('target');

        $(targetTable + ' tbody tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
        });
    });
});