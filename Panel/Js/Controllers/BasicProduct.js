// import {FormManager} from "../../../Core/js/form";
// import {AjaxTask} from "../../../Core/js/ajaxTask";
// import {pageManager} from "../../../Core/js/pageManager";

import {DatasourceAjax} from "../../../../../../Core/Panel/Js/datasourceAjax";
import {ObjectsList} from "../../../../../../Core/Panel/Js/ObjectsList/objectsList";
import {FormManager} from "../../../../../../Core/Panel/Js/form";
import {PanelPageManager} from "../../../../../../Core/Panel/Js/PanelPageManager";
import {AjaxPanel} from "../../../../../../Core/Panel/Js/ajaxPanel";
import {Document, ParseXmlString} from "pmeditor-core"
import {Editor} from "pmeditor-editor"
import {t} from "../../i18n.xml"
import {t as TCommon} from "../../../../../../Core/Panel/Common/i18n.xml"
import FileUploader from "../../../../../../Core/Panel/Js/FileUploader";


export class index {
    constructor(page, data) {
        const container = page.querySelector('.list');
        let datasource = new DatasourceAjax(AjaxPanel.Package.KivapiShop.BasicProduct.BasicProduct.getTable);
        let objectsList = new ObjectsList(datasource);
        objectsList.columns = [];
        objectsList.columns.push({
            name: t('Fields.id'),
            content: row => row.id,
            sortName: 'id',
            width: 180,
            widthGrow: 0
        });
        objectsList.columns.push({
            name: t('Fields.name'),
            content: row => row.name,
            sortName: 'name',
            width: 180,
            widthGrow: 1
        });
        objectsList.columns.push({
            name: t('Fields.price'),
            content: row => row.price+ ' '+row.priceCurrency,
            sortName: 'price',
            width: 180,
            widthGrow: 1
        });


        //objectsList.sort = {"col": "stamp", "desc": true};
        objectsList.generateActions = (rows, mode) => {
            let ret = [];
            // if (rows.length == 1) {
            //     ret.push({
            //         name: TCommonBase("details"),
            //         icon: 'icon-show',
            //         href: "/Balance/show/" + rows[0].id,
            //         main: true
            //     });
            //if (Permissions.can('Balance', 'edit')) {
            ret.push({
                name: TCommon("Edit"),
                icon: 'icon-edit',
                href: "/panel/Package/KivapiShop/BasicProduct/BasicProduct/edit/" + rows[0].id,
            });
            //}
            // }
            // if (mode != 'row' && Permissions.can('Balance', 'edit')) {
            //     ret.push({
            //         name: TCommonBase("openInNewTab"), icon: 'icon-show', showInTable: false, command() {
            //             rows.forEach(x => window.open("/Balance/show/" + x.id))
            //         }
            //     });
            // }
            return ret;
        }
        container.append(objectsList);
        objectsList.refresh();
    }
}

export class add {
    constructor(page, data) {
        this.page = page;
        this.data = data;

        let form = new FormManager(this.page.querySelector('form'));
        //form.loadSelects(this.data.selects);
        const content = new Document();
        const editor = new Editor(content);
        page.querySelector('.editor-container').append(editor.html);

        form.submit = async data => {

            await AjaxPanel.Article.insert(data);
            PanelPageManager.goto('/panel/Package/KivapiShop/BasicProduct/BasicProduct');
        }
    }
}

export class edit {
    constructor(page, data) {
        console.log('dddd')
        this.page = page;
        this.data = data;

        let form = new FormManager(this.page.querySelector('form'));
        form.load(this.data.Product);
        void FileUploader


        form.submit = async formData => {
            formData.photos=form.form.querySelector('[name="photos"]').value;
            await AjaxPanel.Package.KivapiShop.BasicProduct.BasicProduct.update(formData);
            PanelPageManager.goto('/panel/Package/KivapiShop/BasicProduct/BasicProduct');
        }
    }
}
