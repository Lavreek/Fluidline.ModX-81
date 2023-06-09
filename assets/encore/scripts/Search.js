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

        let limit = this.answers.getAttribute('data-search-limit');

        if (value !== "") {
            this.sendRequest(value, uniqid, limit);
        }
    }

    sendRequest(value, uniqid, limit) {
        $.ajax({
            type: "POST",
            url: "http://symfony-mongo.loc/api/product/title/search",
            data: "title=" + value + "&limit=" + limit,
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

                            let search = response.result[i];

                            let title = search['title'];
                            let tag = search['tag'];

                            let hint = title.replace(value, "<span class='hint'>" + value + "</span>");

                            $('#flSiteAnswers').append(
                                "<a class=\"answer-link\" href='/search?title=" + title + "&tag=" + tag + "'>" + hint + "</a>"
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
