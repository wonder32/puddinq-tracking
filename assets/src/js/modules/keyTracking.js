import $ from 'jquery';

function keyTracking(e) {
    if (e.which === 13) {
        alert('You pressed enter!');
    }
}

export {keyTracking}