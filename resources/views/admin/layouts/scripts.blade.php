<script>
    //tinymce init
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: 'textarea#editor',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until May 4, 2026:
                'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'tinymceai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | tinymceai-chat tinymceai-quickactions tinymceai-review | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            tinymceai_token_provider: async () => {
                await fetch(`https://demo.api.tiny.cloud/1/zcpmrtj6pn0htsl1uclms4eltuc5lp10ac1didvxry6la2jq/auth/random`, { method: "POST", credentials: "include" });
                return { token: await fetch(`https://demo.api.tiny.cloud/1/zcpmrtj6pn0htsl1uclms4eltuc5lp10ac1didvxry6la2jq/jwt/tinymceai`, { credentials: "include" }).then(r => r.text()) };
            },
            uploadcare_public_key: 'bcaaa378d540796cb42f',
            elementpath: false,
        });
    }

    //sweetalert2
    $(function () {
        // Prevent default action
        $(document).on('click', '.delete-item', function (e) {
            e.preventDefault();

            var url = $(this).attr('href');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                window.location.reload();
                            }
                        },
                        error: function (xhr) {
                            console.log(error);
                            
                        }
                    });
                }
            });
        });
    })
</script>
