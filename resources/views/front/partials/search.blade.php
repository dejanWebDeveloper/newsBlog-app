<div class="sidebar-box search-form-wrap mb-4">
    <form method="get" action="" class="sidebar-search-form">
        <span class="bi-search"></span>
        <input name="q" type="text" class="form-control" id="searchInput" placeholder="Type a keyword and hit enter">
    </form>
</div>
@push('footer_script')
    <script>
        $('#searchInput').on('keyup', function () {
            let value = $(this).val().toLowerCase();

            $('#articleList li').each(function () {
                let item = $(this);
                let originalText = item.text();
                let lowerText = originalText.toLowerCase();

                if (value && lowerText.includes(value)) {
                    // Prikazuj i highlightuj
                    let regex = new RegExp('(' + value + ')', 'gi');
                    let newText = originalText.replace(regex, '<span class="highlight">$1</span>');
                    item.html(newText);
                    item.show();
                } else if (!value) {
                    // Ako je prazno polje, prikazi original
                    item.html(originalText);
                    item.show();
                } else {
                    // Sakrij stavke koje ne odgovaraju
                    item.hide();
                }
            });
        });
    </script>


@endpush
