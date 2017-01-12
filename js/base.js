 window.onload = function () {
            var input = document.getElementById("file");
            var result = document.getElementById("result");
            var img_area = document.getElementById("img_area");
            if (typeof(FileReader) === 'undefined') {
                result.innerHTML = "©êºp¡A§AªºÂsÄý¾¹¤£¤ä«ù FileReader¡A½Ð¨Ï¥Î²{¥NÂsÄý¾¹¾Þ§@¡I";
                input.setAttribute('disabled', 'disabled');
            } else {
                input.addEventListener('change', readFile, false);
            }
        };
        function readFile() {
            var file = this.files[0];
            //?¨½§Ú?§P?¤U?«¬¦pªG¤£¬O?¤ù´Nªð¦^ ¥h±¼´N¥i¥H¤W?¥ô·N¤å¥ó
            if (!/image\/\w+/.test(file.type)) {
                alert("½Ð½T©w¤å¥ó¬°¹Ï¹³Ãþ«¬");
                return false;
            }
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                var img = new Image,
                        width = 200,    //?¤ùresize?«×
                        quality = 0.9,  //?¹³?¶q
                        canvas = document.createElement("canvas"),
                        drawer = canvas.getContext("2d");
                img.src = this.result;
                canvas.width = width;
                canvas.height = width * (img.height / img.width);
                drawer.drawImage(img, 0, 0, canvas.width, canvas.height);
                img.src = canvas.toDataURL("image/jpeg", quality);
                console.log(img.src);
                //result.innerHTML = '<img src="' + img.src + '" alt=""/>';
                img_area.innerHTML = '<img id="itemimg" src="' + img.src + '" alt=""/><input type="hidden" name="photo_base" value="'+img.src+'">';
				// img_area.innerHTML = '<img id="itemimg" src="' + img.src + '" alt=""/><input type="text" name="photo_base1" value="'+img.src+'">';
            }
        }
