<p align="center">
    <img src="https://laravel.com/assets/img/components/logo-laravel.svg">
</p>

<p align="center">
    <a href="https://packagist.org/packages/masterro/laravel-flashes">
        <img src="https://poser.pugx.org/masterro/laravel-flashes/v/stable" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/masterro/laravel-flashes">
        <img src="https://poser.pugx.org/masterro/laravel-flashes/downloads" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/masterro/laravel-flashes">
        <img src="https://poser.pugx.org/masterro/laravel-flashes/v/unstable" alt="Latest Unstable Version">
    </a>
    <a href="https://github.com/MasterRO94/laravel-flashes/blob/master/LICENSE">
        <img src="https://poser.pugx.org/masterro/laravel-flashes/license" alt="License">
    </a>
</p>

# Laravel Flashes
Fast flash message integration.


## Installation

From the command line, run:

```
composer require masterro/laravel-flashes
```

### Usage

#### Somewhere set the flash message
- `flash("Hello, {$name}!");`
- `flash("Hello, {$name}!", 'success');`
- `flash()->error($message);` `// ->success(), ->info(), ->warning(), ->error()`
- `Flash::info('Flash!');`

#### Before closing `</body>` tag
@include('flash-messages::script')

#### Implement notify method
Package will trigger `notify(message, type)` global javascript function that you should implement. As an example here is bootstrap-notify implementation: 
```javascript
window.notify = (message, type = 'success', options = {}) => {
    if (type === 'error') {
        type = 'danger';
    }

    return window.$.notify(window._.merge({
        message: message
    }, options), {
        type: type,
        animate: {
            enter: 'animated bounceIn',
            exit: 'animated bounceOut'
        },
        z_index: 9999,
        delay: 7000,
        mouse_over: 'pause',
        offset: {
            x: 20,
            y: 30
        }
    });
};
```

It requires `bootstrap`, `bootstrap-notify` and `animate.css`
You can install and require those with yarn or npm:

`yarn add bootstrap-notify` or `npm i bootstrap-notify --save`
