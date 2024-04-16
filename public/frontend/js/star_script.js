var stars = {
    // (A) INIT - ATTACH HOVER & CLICK EVENTS
    init : () => {
        for (let d of document.querySelectorAll(".pStar")) {
            let all = d.querySelectorAll(".star");
            for (let s of all) {
                s.onmouseover = () => stars.hover(all, s.dataset.i);
                s.onclick = () => stars.click(d.dataset.pid, s.dataset.i);
            }
        }
    },

    // (B) HOVER - UPDATE NUMBER OF YELLOW STARS
    hover : (all, rating) => {
        let now = 1;
        for (let s of all) {
            if(now<=rating) {
                s.classList.remove("blank");
            } else {
                s.classList.add("blank");
            }
            now++;
        }
    },

    // (C) CLICK - SUBMIT FORM
    click : (pid, rating) => {
        var vars = "pid="+pid+"&rating="+rating;
        var xhr = new XMLHttpRequest();
        var url = 'save_rating.php';
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
                var return_data = xhr.responseText;
                var data = JSON.parse(return_data);
                var rating_percent = data.avg_rating * 20;
                document.getElementById("pid-"+pid).style.width = rating_percent+'%';
            }
        }
        xhr.send(vars);
    }
};
window.onload = stars.init;