(function ($) {

    function loadFile(callback) {
        var req = new XMLHttpRequest();

        req.onreadystatechange = function () {
            if (req.readyState == 4) {
                callback(req.response);
            }
        };
        req.open("GET", "team.json", true);
        req.send();
    }

    var dataProcessor = function (response) {

        var data = JSON.parse(response);
        var members = data.team.member;

        members.forEach(function (member) {
            var category = member.category,
                id = member.id,
                image = "<div class='image'><img src='images/team/" + member.image + "'/></div>",
                name = "<a class='name'>" + member.name + "</a>",
                role = "<a class='role'>" + member.role + "</a>",
                tel = "<a href='tel:" + member.tel + "'>" + member.tel + "</a>";


            var fb = "<a href='" + member.link.fb + "' target='_blank'><i class='fa fa-facebook'></i></a>";

            if (member.link.gh != null) {
                var gh = "<a href='" + member.link.gh + "' target='_blank'><i class='fa fa-github'></i></a>";

                var contact = tel + "<br><br>" + fb + gh;
            } else {
                var contact = tel + "<br><br>" + fb;
            }


            var html = $("<div class='team-member' data-cat='" + category + "'>" + image + "<div class='label'><div class='label-text'>" + name + role + "<p class='contact'>" + contact + "</p></div><div class='label-bg'></div></div></div>");

            $('#team').append(html);
        })
    };

    function catbtns() {

        var catbtns = $(".cat-btns"),
            active = "all",
            reset = function(){
                $(".team-member").removeAttr("style");
            }

        catbtns.find("#all").addClass("active");

        $(".cat-btn").on("click", function () {
            
            catbtns.find("#" + active).removeClass("active");
            active = $(this).attr('id');
            catbtns.find("#" + active).addClass("active");
            
            if (active == "all") {
                reset();
            } else {
                reset();
                $(".team-member:not([data-cat='" + active + "' ])").css("display", "none");
            }
        })
    }

    loadFile(dataProcessor);
    catbtns();
})(jQuery);