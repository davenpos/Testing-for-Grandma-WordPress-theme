import $ from 'jquery';

class Like {
    constructor() {
        this.events()
    }

    events() {
        $(".likebox").on("click", this.clickDispatcher.bind(this));
    }

    clickDispatcher(e) {
        var currentLikeBox = $(e.target).closest(".likebox");
        if (currentLikeBox.attr('data-exists') == 'yes') {
            this.deleteLike(currentLikeBox);
        } else {
            this.createLike(currentLikeBox);
        }
    }

    createLike(clb) {
        $.ajax({
            url: siteData.root_url + '/wp-json/testForGrandma/v1/manageLike',
            type: 'POST',
            data: {'postID': clb.data('post')},
            success: (response) => {
                clb.attr('data-exists', 'yes');
                var likeCount = parseInt(clb.find(".likecount").html(), 10);
                likeCount++;
                clb.find(".likecount").html(likeCount);
                clb.attr("data-like", response);
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            },
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', siteData.nonce);
            }
        });
    }
    
    deleteLike(clb) {
        $.ajax({
            url: siteData.root_url + '/wp-json/testForGrandma/v1/manageLike',
            data: {'like': clb.attr('data-like')},
            type: 'DELETE',
            success: (response) => {
                clb.attr('data-exists', 'no');
                var likeCount = parseInt(clb.find(".likecount").html(), 10);
                likeCount--;
                clb.find(".likecount").html(likeCount);
                clb.attr("data-like", '');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            },
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', siteData.nonce);
            }
        });
    }
}

export default Like;