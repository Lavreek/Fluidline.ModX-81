const $ = require('jquery');

class HeaderSearch {

    constructor() {
        this.answers = document.getElementById('flSiteAnswers');
    }

    eraseAnswers() {
        this.answers.innerText = "";
    }

    setUniqSearch(uniqid) {
        this.answers.setAttribute('data-search-uniqid', uniqid);
    }

    searchTitle(value) {
        this.eraseAnswers();

        let uniqid = Date.now();
        this.setUniqSearch(uniqid);

        if (value !== "") {
            this.sendRequest(value, uniqid);
        }
    }

    sendRequest(value, uniqid) {
        $.ajax({
            type: "POST",
            url: "http://symfony-mongo.loc/api/product/title/search",
            data: "title=" + value,
            enctype: 'application/x-www-form-urlencoded',
            contentType: 'application/x-www-form-urlencoded',
            processData: false,
            cache: false,

            statusCode: {
                200: function (response) {
                    if (response.result !== undefined) {
                        let answers = document.getElementById('flSiteAnswers');

                        for (let i = 0; i < response.result.length; i++) {
                            if (Number(answers.getAttribute('data-search-uniqid')) !== uniqid) {
                                return;
                            }

                            let find = response.result[i];
                            find = find.replace(value, "<span class='hint'>" + value + "</span>");

                            $('#flSiteAnswers').append(
                                "<a class=\"answer-link\" href='#'>" +
                                    // find.replace(value, "<span class='hint'>" + value + "</span>") +
                                    find +
                                "</a>"
                            );
                        }
                    }
                },
                400: function (response) {
                    // console.log(400, response);
                    return response;
                },
                500: function (response) {
                    // console.log(500, response);
                    return response;
                }
            }
        });
    }
}

let search = new HeaderSearch();

$('#flSiteSearch').on('input', function () {
    search.searchTitle($(this).val())
})
