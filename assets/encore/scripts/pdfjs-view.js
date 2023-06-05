const $ = require('jquery');

const pdfjsLib = require('pdfjs-dist/build/pdf');
pdfjsLib.GlobalWorkerOptions.workerSrc = '/node_modules/pdfjs-dist/build/pdf.worker.min.js';


function createPdfView(file, fullView, filePreview) {
    pdfjsLib.getDocument(file).promise.then(doc => {
        doc.getPage(1).then(firstPage => {
            let preview = document.createElement('canvas');

            let previewContext = preview.getContext('2d');
            let previewViewport = firstPage.getViewport({scale: 2});

            preview.width = previewViewport.width;
            preview.height = previewViewport.height;

            document.querySelector('#' + filePreview).appendChild(preview);

            firstPage.render({
                canvasContext: previewContext,
                viewport: previewViewport
            });
        });
    });

    pdfjsLib.getDocument(file).promise.then(doc => {
        let pages_count = doc._pdfInfo.numPages;

        for (let i = 1; i <= pages_count; i++) {
            doc.getPage(i).then(page => {
                let canvas =  document.createElement('canvas');

                canvas.setAttribute('data-page', i);

                canvas.onclick = function () {
                    $('body').css('overflow', 'hidden');

                    let canvas = document.getElementById(fullView);

                    canvas.parentNode.style.display = 'inline-flex';

                    let context = canvas.getContext('2d');
                    let viewport = page.getViewport({scale: 2});
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;

                    canvas.parentNode.onclick = function (e) {
                        if (!$(e.target).closest('span.options').length) {
                            // $('body').css('overflow', 'auto');
                            this.style.display = 'none';
                        }
                    };

                    page.render({
                        canvasContext: context,
                        viewport: viewport
                    });
                };

                document.querySelector('#body-' + filePreview).appendChild(canvas);

                let context = canvas.getContext('2d');
                let viewport = page.getViewport({scale: 1});

                canvas.width = viewport.viewBox[2];
                canvas.height = viewport.viewBox[3];

                page.render({
                    canvasContext: context,
                    viewport: viewport
                });
            });
        }
    });
}

let certs = $('.cert-preview');

certs.each(function (item) {
    let cert = certs[item];
    createPdfView(cert.getAttribute('data-mx-cert'), 'cert-fullview-' + cert.getAttribute('data-mx-cid'), cert.getAttribute('id'));
});
