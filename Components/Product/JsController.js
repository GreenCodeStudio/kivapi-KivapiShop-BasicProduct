import {Ajax} from "../../../../../Core/Js/Ajax";

export default class {
    constructor() {
        console.log('basic product js');
        document.querySelectorAll('.addToCartButton').forEach(b => {
            b.onclick = async () => {
                await this.getCartId()
                Ajax.KivapiShop.Order.Cart.addToCart(b.dataset.productType, b.dataset.productId, 1);
            }
        })
    }

    async getCartId() {
        console.log('getCartId')
        if (await window.cookieStore.get('kshop_cartId')) {
            return await window.cookieStore.get('kshop_cartId').value
        } else {
            const id = this.uuidv4();
            await window.cookieStore.set({
                name: 'kshop_cartId', value: id, path: '/', expires: +new Date() + 365 * 24 * 60 * 60 * 1000
            })
            return id;
        }
    }

    uuidv4() {
        return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, c =>
            (+c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> +c / 4).toString(16)
        );
    }
}
