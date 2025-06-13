const image = document.querySelector('#preview-360-class')

if($('#preview-360-class').length > 0) {
    const viewer = new PhotoSphereViewer.Viewer({
    container: 'preview-360-class',
    panorama: image.dataset.image,
    caption: 'Parc national du Mercantour <b>&copy; Damien Sorel</b>',
    touchmoveTwoFingers: true,
    mousewheelCtrlKey: true,
    });
}