<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Model Viewer</title>
    <script type="module" src="model-viewer.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Xem Mô Hình Sản Phẩm</h1>
        <model-viewer 
            id="modelViewer"
            src="https://anhemblender.com/test/tt.glb" 
            alt="A 3D model of a product" 
            auto-rotate 
            camera-controls
            touch-action="pan-y" 
            skybox-image="hdri.jpg" 
            shadow-intensity="1" 
            background-color="#FFFFFF" 
            ground-plane="true" 
            environment-image="neutral">
        </model-viewer>
        
        <div class="loading" id="loading">
            <p>Đang tải mô hình...</p>
            <div class="loading-bar" id="loadingBar"></div>
            <div class="loading-percent" id="loadingPercent">0%</div>
        </div>
        
        <div class="color-selector">
            <button onclick="changeModel('https://anhemblender.com/test/tt.glb')">Mẫu 1</button>

        </div>
        
        <button class="fullscreen-btn" id="fullscreenButton">Toàn Màn Hình</button>
    </div>

    <script>
        const modelViewer = document.getElementById('modelViewer');
        const loading = document.getElementById('loading');
        const loadingBar = document.getElementById('loadingBar');
        const loadingPercent = document.getElementById('loadingPercent');
        const fullscreenButton = document.getElementById('fullscreenButton');

        // Biến lưu trữ góc nhìn camera
        let cameraOrbit, cameraTarget;

        // Sự kiện khi bắt đầu tải mô hình
        modelViewer.addEventListener('model-load', () => {
            loading.style.display = 'none'; // Ẩn loading khi mô hình đã tải
        });

        // Sự kiện để cập nhật tiến trình tải
        modelViewer.addEventListener('progress', (event) => {
            const progress = (event.detail.totalProgress * 100).toFixed(0); // Tính toán tiến trình
            loadingBar.style.width = `${progress}%`;
            loadingPercent.textContent = `${progress}%`; // Cập nhật phần trăm

            if (progress < 100) {
                loading.style.display = 'block'; // Hiển thị loading
            } else {
                loading.style.display = 'none'; // Ẩn loading khi đã hoàn thành
            }
        });

        // Sự kiện để lưu trữ góc nhìn hiện tại
        modelViewer.addEventListener('camera-change', () => {
            cameraOrbit = modelViewer.cameraOrbit;
            cameraTarget = modelViewer.cameraTarget;
        });

        function changeModel(modelSrc) {
            // Thay đổi mô hình
            modelViewer.src = modelSrc;

            // Reset loading bar
            loadingBar.style.width = '0%'; // Đặt lại thanh tiến trình
            loadingPercent.textContent = `0%`; // Đặt lại phần trăm
            loading.style.display = 'block'; // Hiển thị loading
        }

        fullscreenButton.addEventListener('click', () => {
            if (modelViewer.requestFullscreen) {
                modelViewer.requestFullscreen();
            } else if (modelViewer.mozRequestFullScreen) { // Firefox
                modelViewer.mozRequestFullScreen();
            } else if (modelViewer.webkitRequestFullscreen) { // Chrome, Safari, and Opera
                modelViewer.webkitRequestFullscreen();
            } else if (modelViewer.msRequestFullscreen) { // IE/Edge
                modelViewer.msRequestFullscreen();
            }
        });
    </script>
</body>
</html>
