// CKEditor
ClassicEditor.create(document.querySelector("#editor"), {
    removePlugins: [
        // Menghilangkan input media
        "CKFinderUploadAdapter",
        "CKFinder",
        "EasyImage",
        "Image",
        "ImageCaption",
        "ImageStyle",
        "ImageToolbar",
        "ImageUpload",
        "MediaEmbed",
    ],
})
    .then((editor) => {
        // mengecek error dan mengatur ukuran
        editor.editing.view.change((writer) => {
            writer.setStyle(
                "min-height",
                "160px",
                editor.editing.view.document.getRoot()
            );
            writer.setStyle(
                "max-height",
                "1000px",
                editor.editing.view.document.getRoot()
            );
        });
        console.log("aman");
    })
    // .catch((error) => {
    //     console.error("error");
    // });
// End CKEditor

// scroll button
$(document).ready(function () {
    function toggleScrollButton() {
        var scrollPosition = $(window).scrollTop();
        var windowHeight = $(window).height();
        var documentHeight = $(document).height();

        if (scrollPosition + windowHeight < documentHeight) {
            $("#scrollButton").fadeIn();
        } else {
            $("#scrollButton").fadeOut();
        }
    }

    // Menjalankan saat mengulir dan merubah ukuran tampilan
    $(window).scroll(function () {
        toggleScrollButton();
    });
    $(window).resize(function () {
        toggleScrollButton();
    });

    $("#scrollButton").click(function () {
        $("html, body").animate(
            {
                scrollTop: $(document).height(),
            },
            "slow"
        );
    });

    // Menjalankan saat dimuat
    toggleScrollButton();
});

$(document).ready(function () {
    // Menampilkan tombol "Scroll to Top" saat pengguna menggulir ke bawah
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $("#scrollToTopButton").fadeIn();
        } else {
            $("#scrollToTopButton").fadeOut();
        }
    });

    // Menggulir halaman kembali ke atas saat tombol diklik
    $("#scrollToTopButton").click(function () {
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            "slow"
        );
    });
});

// End scroll button
