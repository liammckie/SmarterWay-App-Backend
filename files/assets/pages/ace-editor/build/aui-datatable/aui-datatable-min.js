AUI.add("aui-datatable-base",function(e){var j=e.Lang,c=e.ArraySort.compare,o=j.isNumber,d=j.isString,h="change",m="childNodes",i="columnset",f="data",k="headers",l="id",b="recordset",g="recordsetChange",a="#",n=" ";e.DataTable.Base=e.Base.create("datatable",e.DataTable.Base,[],{initializer:function(){var p=this;p.after(p._uiSetRecordsetExt,p,"_uiSetRecordset");},getCellNode:function(q,r){var p=this;return p.getRowNode(q).get(m).item(r.keyIndex);},getColNode:function(q){var p=this;var s=p.get(i);var r=s.getColumnIndex(s.getColumnByCell(q));return p._colgroupNode.get(m).item(r);},getRowNode:function(p){return e.one(a+p.get(l));},_fixPluginsUI:function(){var q=this;var r=q.sort;var p=q.scroll;if(r&&p){p.syncUI();}},_uiSetRecordsetExt:function(q){var p=this;p._fixPluginsUI();}},{});e.Column=e.Base.create("column",e.Column,[],{},{ATTRS:{sortFn:{value:function(r,p,s,t){var q=c(r.getValue(s),p.getValue(s),t);if(q===0){q=c(r.get("id"),p.get("id"),t);}return q;}}}});e.Columnset=e.Base.create("columnset",e.Columnset,[],{getColumn:function(q){var p=this;if(d(q)){return this.idHash[q];}else{if(o(q)){return p.keys[q];}}return null;},getColumnByCell:function(q){var p=this;var r=q.getAttribute(k).split(n).pop()||q.get(l);return p.getColumn(r);},getColumnIndex:function(p){return p.keyIndex;},getLength:function(){var p=this;return p.keys.length;},_setDefinitions:function(p){return p;}},{});e.Recordset=e.Base.create("recordset",e.Recordset,[],{getRecordByRow:function(q){var p=this;return p.getRecord(q.get(l));},getRecordIndex:function(q){var p=this;return e.Array.indexOf(p._items,q);},updateRecordDataByKey:function(q,r,t){var p=this;var s=q.get(f);if(s){s[r]=t;q.set(f,s);}p.update(q,p.getRecordIndex(q));}},{});e.Plugin.RecordsetSort.prototype._defSortFn=function(s){var p=this;var r=p.get("host");var q=r._items;e.Array.stableSort(q,function(u,t){return s.sorter.call(q,u,t,s.field,s.desc);});p.set("lastSortProperties",s);};},"@VERSION@",{requires:["aui-base","datatable","plugin"],skinnable:true});AUI.add("aui-datatable-events",function(j){var R=j.Lang,s=R.isArray,F=R.isObject,e=R.isValue,b=j.Array.each,E=j.Object.keys,L=j.Object.values,x=j.Selector.test,l=j.ClassNameManager.getClassName,t=j.cached(function(A){return A.substring(0,1).toUpperCase()+A.substring(1);}),h=j.cached(function(S,A){return S+t(A.toLowerCase());}),M="boundingBox",O="cell",D="cellSelector",H="click",n="column",r="dblclick",c="events",w="header",p="host",d="inHead",Q="keydown",P="keyup",G="liner",y="mousedown",f="mouseenter",k="mouseleave",i="mouseup",C="recordset",I="row",u="table",N="tags",a="tagName",J="tbody",v="thead",B="tr",m="datatable",z="columnset",o=",",q=".",K=l(m,G);var g=j.Base.create("dataTableEvents",j.Plugin.Base,[],{_bubbling:false,_handler:null,_tagsFilter:null,initializer:function(T){var A=this;var S=A.get(N);A._tagsFilter=E(S).join(o);A._initEvents();},destructor:function(){var A=this;var S=A._handler;if(S){S.detach();}},updateEventPayload:function(V,S){var A=this;var U=A.get(p);var W=U._theadNode;var X=V.getData(d);var T=V.getData(G);var Y=V.getData(I);if(!e(X)){X=W.contains(V);V.setData(d,X);}if(!e(T)){T=V.one(q+K);V.setData(G,T);}if(!e(Y)){Y=V.ancestor(B);V.setData(I,Y);}return j.mix(S,{cell:V,column:U.get(z).getColumnByCell(V),inHead:X,liner:T,originalEvent:S,row:Y,record:U.get(C).getRecordByRow(Y)},true);},_filterBubble:function(X){var A=this;var W=A.get(p);var S=W._tableNode.getDOM();var T=[];while(X){var V=(X===S);if(x(X,A._tagsFilter,(V?null:S))){T.push(X);}if(V){break;}X=X.parentNode;}if(T.length){var U=W.getColNode(j.one(T[0]));if(U){T.splice(2,0,U.getDOM());}}return T;},_handleEvents:function(A){var W,U;var Z=this;var aa=Z.get(p);var ab=Z.get(N);var T=A.currentTarget;var S=Z._filterBubble(T.getDOM());var Y=Z.updateEventPayload(T,A);Z._bubbling=true;for(W=0,U=S.length;(W<U)&&Z._bubbling;W++){var V=j.one(S[W]);var X=ab[V.get(a).toLowerCase()];Y.node=V;Y.property=X;aa.fire(h(X,A.type),Y);}},_initEvents:function(){var A=this;var V=A.get(p);var S=A.get(N);var T=A.get(c);var U={};b(L(S),function(W){b(T,function(X){var Y=h(W,X);U[Y]={stoppedFn:j.bind(A._stopBubble,A)};});});V.publish(U);A._handler=V.get(M).delegate(T,j.bind(A._handleEvents,A),A.get(D));},_stopBubble:function(){var A=this;A._bubbling=false;}},{NS:"events",NAME:"dataTableEvents",ATTRS:{cellSelector:{value:"td,th",writeOnce:true},events:{validator:s,value:[H,r,Q,P,y,f,k,i]},tags:{validator:F,value:{col:n,table:u,thead:v,tbody:J,tr:I,th:w,td:O},writeOnce:true}}});j.namespace("Plugin").DataTableEvents=g;},"@VERSION@",{requires:["aui-datatable-base"]});AUI.add("aui-datatable-edit",function(av){var ae=av.Lang,bf=av.Array,O=av.Escape,e=ae.isArray,aU=ae.isBoolean,aP=ae.isFunction,J=ae.isObject,aZ=ae.isString,aO=ae.String,aM=av.cached(function(A){return A.substring(0,1).toUpperCase()+A.substring(1);}),a5=function(A){return(A instanceof av.BaseCellEditor);},ar=av.WidgetStdMod,B=av.getClassName,ag="add",a6="addOption",aN="baseCellEditor",s="boundingBox",S="calendar",an="cancel",aR="cell",az="celleditor",D="checkboxCellEditor",p="checked",aJ="click",C="columnset",w="contentBox",aF="data",R="datatable",M="dateCellEditor",am="dd",W="delete",aq="disk",aH="dotted",aQ="dropDownCellEditor",N="edit",aa="editable",f="editor",G="editEvent",ak="editOptions",I="element",aE="elementName",aS="field",c="grip",F="handle",v="hide",ax="hideOnSave",ai="icon",aI="id",o="initEdit",be="initToolbar",aw="initValidator",ac="input",d="inputFormatter",bd="key",ay="label",at="link",Y="mousedown",ab="multiple",m="name",aW="option",a1="options",u="optionsCellEditor",ba="outputFormatter",l="pencil",al="radioCellEditor",aj="records",k="recordset",bb="remove",a8="rendered",ah="return",n="row",aL="save",aX="selected",aC="selectedAttrName",Z="showToolbar",a0="submit",T="textAreaCellEditor",y="textCellEditor",Q="toolbar",z="unescapeValue",X="validator",a4="value",au="vertical",af="visible",a2="wrapper",bi=",",i=".",U="",h="#",a7="\n",bc=" ",t=/<br\s*\/?>/gi,E=/[\r\n]/g,b=B(az,N),g=B(az,N,ag,aW),bh=B(az,N,am,F),aV=B(az,N,W,aW),a9=B(az,N,v,aW),aA=B(az,N,ac,m),aK=B(az,N,ac,a4),ap=B(az,N,ay),q=B(az,N,at),aD=B(az,N,aW,n),V=B(az,I),aY=B(az,ay),L=B(az,aW),x=B(az,a2),H=B(R,aa),j=B(ai),ad=B(ai,c,aH,au),aT="<br/>";
var a3=function(){};a3.NAME="dataTableCellEditorSupport";a3.ATTRS={editEvent:{setter:"_setEditEvent",validator:aZ,value:aJ}};av.mix(a3.prototype,{initializer:function(){var A=this;A.after({render:A._afterRenderEditor});A.on(A.get(G),A._onCellEdit);A.after(A._afterUiSetRecordset,A,"_uiSetRecordset");},getCellEditor:function(bj,bl){var A=this;var bk=bl.get(f);var bm=bj.get(aF).editor;if(bk===false||bm===false){return null;}return bm||bk;},getRecordColumnValue:function(A,bj){return A.getValue(bj.get(aS));},syncEditableColumnsUI:function(){var A=this;var bk=A.get(C);var bj=A.get(k);av.each(bk.idHash,function(bm){var bl=bm.get(f);if(a5(bl)){av.all("[headers="+bm.get(aI)+"]").addClass(H);}});av.each(bj.get(aj),function(bl){var bm=bl.get(aF).editor;var bn=a5(bm);av.all(h+bl.get("id")+">td").each(function(bq,bo){var bp=bk.getColumn(bo);if(bm===false){bq.removeClass(H);}else{if(bn||(bp.get(f)!==false)){bq.addClass(H);}}});});},_afterUiSetRecordset:function(bj){var A=this;A.syncEditableColumnsUI();},_afterRenderEditor:function(bj){var A=this;if(!A.events){A.plug(av.Plugin.DataTableEvents);}},_editCell:function(bn){var A=this;var bp=A.get(C);var bo=A.get(k);var bm=bn.column;var bj=bn.record;A.activeColumnIndex=bp.getColumnIndex(bm);A.activeRecordIndex=bo.getRecordIndex(bj);var bk=bn.alignNode||bn.cell;var bl=A.getCellEditor(bj,bm);if(a5(bl)){if(!bl.get(a8)){bl.on({visibleChange:av.bind(A._onEditorVisibleChange,A),save:av.bind(A._onEditorSave,A)});bl.render();}bl.set(a4,A.getRecordColumnValue(bj,bm));bl.show().move(bk.getXY());}},_onCellEdit:function(bj){var A=this;A._editCell(bj);},_onEditorVisibleChange:function(bo){var bj=this;var bm=bo.currentTarget;var bl=bj.selection;if(bl){var bk=bl.getActiveRecord();var bn=bl.getActiveColumn();var A=bj.getCellNode(bk,bn);var bp=bj.getRowNode(bk);if(bo.newVal){bm._syncFocus();}else{bl.select(A,bp);}}},_onEditorSave:function(bm){var A=this;var bl=bm.currentTarget;var bn=A.get(k);bl.set(a4,bm.newVal);var bk=A.selection;if(bk){var bj=av.Escape.html(bm.newVal);bn.updateRecordDataByKey(bk.getActiveRecord(),bk.getActiveColumn().get(bd),bj);}},_setEditEvent:function(A){return aR+aM(A);}});av.DataTable.CellEditorSupport=a3;av.DataTable.Base=av.Base.create("dataTable",av.DataTable.Base,[av.DataTable.CellEditorSupport]);var r=av.Component.create({NAME:aN,ATTRS:{editable:{value:false,validator:aU},elementName:{value:a4,validator:aZ},footerContent:{value:U},hideOnSave:{value:true,validator:aU},inputFormatter:{value:function(A){if(aZ(A)){A=A.replace(E,aT);}return A;}},outputFormatter:{value:function(bj){var A=this;if(aZ(bj)){if(A.get(z)){bj=aO.unescapeEntities(bj);}bj=bj.replace(t,a7);}return bj;}},showToolbar:{value:true,validator:aU},strings:{value:{edit:"Edit",save:"Save",cancel:"Cancel"}},tabIndex:{value:1},toolbar:{setter:"_setToolbar",validator:J,value:null},unescapeValue:{value:true,validator:aU},validator:{setter:"_setValidator",validator:J,value:null},value:{value:U},visible:{value:false}},EXTENDS:av.Overlay,UI_ATTRS:[aa,Z,a4],prototype:{CONTENT_TEMPLATE:"<form></form>",ELEMENT_TEMPLATE:null,elements:null,validator:null,_hDocMouseDownEv:null,initializer:function(bj){var A=this;A._initEvents();},destructor:function(){var bj=this;var A=bj._hDocMouseDownEv;var bl=bj.toolbar;var bk=bj.validator;if(A){A.detach();}if(bl){bl.destroy();}if(bk){bk.destroy();}},bindUI:function(){var A=this;A.get(s).on(bd,av.bind(A._onEscKey,A),"down:27");},formatValue:function(bj,bk){var A=this;if(aP(bj)){bk=bj.call(A,bk);}return bk;},getValue:function(){var A=this;return A.formatValue(A.get(d),A.getElementsValue());},_initEvents:function(){var A=this;A.publish({cancel:{defaultFn:A._defCancelFn},initEdit:{defaultFn:A._defInitEditFn,fireOnce:true},initValidator:{defaultFn:A._defInitValidatorFn,fireOnce:true},initToolbar:{defaultFn:A._defInitToolbarFn,fireOnce:true},save:{defaultFn:A._defSaveFn}});A.after({render:A._afterRender,visibleChange:av.debounce(A._debounceVisibleChange,350,A)});A.on({"form-validator:submit":av.bind(A._onSubmit,A)});},_afterRender:function(){var A=this;A._handleInitValidatorEvent();A._handleInitToolbarEvent();},_defCancelFn:function(bj){var A=this;A.hide();},_defInitValidatorFn:function(bj){var A=this;A.validator=new av.FormValidator(A.get(X));},_defInitToolbarFn:function(bk){var A=this;var bj=A.get(aa);A.toolbar=new av.Toolbar(A.get(Q)).render(A.footerNode);if(bj){A._uiSetEditable(bj);}},_defSaveFn:function(bj){var A=this;if(A.get(ax)){A.hide();}},_debounceVisibleChange:function(bk){var bj=this;var A=bj._hDocMouseDownEv;if(bk.newVal){if(!A){bj._hDocMouseDownEv=av.getDoc().on(Y,av.bind(bj._onDocMouseDownExt,bj));}}else{if(A){A.detach();bj._hDocMouseDownEv=null;}}},_handleCancelEvent:function(){var A=this;A.fire(an);},_handleEditEvent:function(){var A=this;A.fire(N);},_handleInitEditEvent:function(){var A=this;if(A.get(a8)){this.fire(o);}},_handleInitValidatorEvent:function(){var A=this;if(A.get(a8)){this.fire(aw);}},_handleInitToolbarEvent:function(){var A=this;if(A.get(a8)&&A.get(Z)){this.fire(be);}},_handleSaveEvent:function(){var A=this;if(!A.validator.hasErrors()){A.fire(aL,{newVal:A.getValue(),prevVal:A.get(a4)});}},_onDocMouseDownExt:function(bk){var A=this;var bj=A.get(s);if(!bj.contains(bk.target)){A.set(af,false);}},_onEscKey:function(bj){var A=this;A.hide();},_onSubmit:function(bk){var A=this;var bj=bk.validator;A._handleSaveEvent();if(bj){bj.formEvent.halt();}},_setToolbar:function(bk){var bj=this;var A=bj.getStrings();return av.merge({activeState:false,children:[{label:A[aL],icon:aq,type:a0},{handler:av.bind(bj._handleCancelEvent,bj),label:A[an]}]},bk);},_setValidator:function(bj){var A=this;return av.merge({boundingBox:A.get(w),bubbleTargets:A},bj);},_uiSetShowToolbar:function(bk){var A=this;var bj=A.footerNode;if(bk){bj.show();}else{bj.hide();}A._handleInitToolbarEvent();},getElementsValue:function(){var A=this;var bj=A.elements;if(bj){return bj.get(a4);}return U;},renderUI:function(){var A=this;if(A.ELEMENT_TEMPLATE){A.elements=av.Node.create(A.ELEMENT_TEMPLATE);
A._syncElementsName();A.setStdModContent(ar.BODY,A.elements);}},_defInitEditFn:function(A){},_syncElementsFocus:function(){var A=this;A.elements.selectText();},_syncElementsName:function(){var A=this;A.elements.setAttribute(m,A.get(aE));},_syncFocus:function(){var A=this;av.later(0,A,A._syncElementsFocus);},_uiSetEditable:function(bk){var A=this;var bj=A.toolbar;if(A.get(a8)&&bj){if(bk){bj.add({handler:av.bind(A._handleEditEvent,A),icon:l,label:A.getString(N)},1);}else{bj.remove(1);}}},_uiSetValue:function(bk){var A=this;var bj=A.elements;if(bj){bj.val(A.formatValue(A.get(ba),bk));}}}});av.BaseCellEditor=r;var bg=av.Component.create({NAME:u,ATTRS:{inputFormatter:{value:null},options:{setter:"_setOptions",value:{},validator:J},outputFormatter:{value:null},selectedAttrName:{value:aX,validator:aZ},strings:{value:{add:"Add",cancel:"Cancel",addOption:"Add option",edit:"Edit options",editOptions:"Edit option(s)",name:"Name",remove:"Remove",save:"Save",stopEditing:"Stop editing",value:"Value"}}},EXTENDS:av.BaseCellEditor,UI_ATTRS:[a1],prototype:{EDIT_TEMPLATE:'<div class="'+b+'"></div>',EDIT_OPTION_ROW_TEMPLATE:'<div class="'+aD+'">'+'<span class="'+[bh,j,ad].join(bc)+'"></span>'+'<input class="'+aA+'" size="7" placeholder="{titleName}" title="{titleName}" type="text" value="{valueName}" /> '+'<input class="'+aK+'" size="7" placeholder="{titleValue}" title="{titleValue}" type="text" value="{valueValue}" /> '+'<a class="'+[q,aV].join(bc)+'" href="javascript:void(0);">{remove}</a> '+"</div>",EDIT_ADD_LINK_TEMPLATE:'<a class="'+[q,g].join(bc)+'" href="javascript:void(0);">{addOption}</a> ',EDIT_LABEL_TEMPLATE:'<div class="'+ap+'">{editOptions}</div>',editContainer:null,editSortable:null,options:null,initializer:function(){var A=this;A.on(N,A._onEditEvent);A.on(aL,A._onSave);A.after(be,A._afterInitToolbar);},addNewOption:function(bl,bm){var A=this;var bk=A.editContainer.one(i+g);var bj=av.Node.create(A._createEditOption(bl||U,bm||U));bk.placeBefore(bj);bj.one(ac).focus();},removeOption:function(A){A.remove();},saveOptions:function(){var A=this;var bm=A.editContainer;if(bm){var bl=bm.all(i+aA);var bj=bm.all(i+aK);var bk={};bl.each(function(bp,bo){var bn=bp.val();var bq=bj.item(bo).val();bk[bq]=bn;});A.set(a1,bk);A._uiSetValue(A.get(a4));A.toggleEdit();}},toggleEdit:function(){var A=this;A.editContainer.toggle();},_createOptions:function(bk){var bo=this;var A=bo.elements;var bm=[];var bj=[];var bl=bo.OPTION_TEMPLATE;var bp=bo.OPTION_WRAPPER;av.each(bk,function(bt,bs){var br={id:av.guid(),label:O.html(bt),name:O.html(bs),value:O.html(bs)};if(bl){bm.push(ae.sub(bl,br));}if(bp){bj.push(ae.sub(bp,br));}});var bq=av.NodeList.create(bm.join(U));var bn=av.NodeList.create(bj.join(U));if(bn.size()){bn.each(function(bs,br){bs.prepend(bq.item(br));});A.setContent(bn);}else{A.setContent(bq);}bo.options=bq;},_createEditBuffer:function(){var bj=this;var A=bj.getStrings();var bk=[];bk.push(ae.sub(bj.EDIT_LABEL_TEMPLATE,{editOptions:A[ak]}));av.each(bj.get(a1),function(bl,bm){bk.push(bj._createEditOption(bl,bm));});bk.push(ae.sub(bj.EDIT_ADD_LINK_TEMPLATE,{addOption:A[a6]}));return bk.join(U);},_createEditOption:function(bk,bl){var bj=this;var A=bj.getStrings();return ae.sub(bj.EDIT_OPTION_ROW_TEMPLATE,{remove:A[bb],titleName:O.html(A[m]),titleValue:O.html(A[a4]),valueName:O.html(bk),valueValue:O.html(bl)});},_defInitEditFn:function(bj){var A=this;var bk=av.Node.create(A.EDIT_TEMPLATE);bk.delegate("click",av.bind(A._onEditLinkClickEvent,A),i+q);bk.delegate("keydown",av.bind(A._onEditKeyEvent,A),ac);A.editContainer=bk;A.setStdModContent(ar.BODY,bk.hide(),ar.AFTER);A.editSortable=new av.Sortable({container:bk,handles:[i+bh],nodes:i+aD,opacity:".3"}).delegate.dd.plug(av.Plugin.DDConstrained,{constrain:bk,stickY:true});A._syncEditOptionsUI();},_getSelectedOptions:function(){var A=this;var bj=[];A.options.each(function(bk){if(bk.get(A.get(aC))){bj.push(bk);}});return av.all(bj);},_onEditEvent:function(bj){var A=this;A._handleInitEditEvent();A.toggleEdit();A._syncEditOptionsUI();},_onEditLinkClickEvent:function(bj){var A=this;var bk=bj.currentTarget;if(bk.test(i+g)){A.addNewOption();}else{if(bk.test(i+a9)){A.toggleEdit();}else{if(bk.test(i+aV)){A.removeOption(bk.ancestor(i+aD));}}}bj.halt();},_onEditKeyEvent:function(bj){var A=this;var bk=bj.currentTarget;if(bj.isKey(ah)){var bl=bk.next(ac);if(bl){bl.selectText();}else{A.addNewOption();}bj.halt();}},_onSave:function(bj){var A=this;A.saveOptions();},_setOptions:function(bj){var A={};if(e(bj)){bf.each(bj,function(bk){A[bk]=bk;});}else{if(J(bj)){A=bj;}}return A;},_syncEditOptionsUI:function(){var A=this;A.editContainer.setContent(A._createEditBuffer());},_uiSetOptions:function(bj){var A=this;A._uiSetValue(A.get(a4));A._createOptions(bj);A._syncElementsName();},_uiSetValue:function(bk){var A=this;var bj=A.options;if(bj&&bj.size()){bj.set(A.get(aC),false);if(bk){if(!e(bk)){bk=bk.split(bi);}bf.each(bk,function(bl){bj.filter('[value="'+O.html(ae.trim(bl))+'"]').set(A.get(aC),true);});}}return bk;}}});av.BaseOptionsCellEditor=bg;var aB=av.Component.create({NAME:y,EXTENDS:av.BaseCellEditor,prototype:{ELEMENT_TEMPLATE:'<input autocomplete="off" class="'+V+'" type="text" />'}});av.TextCellEditor=aB;var aG=av.Component.create({NAME:T,EXTENDS:av.BaseCellEditor,prototype:{ELEMENT_TEMPLATE:'<textarea class="'+V+'"></textarea>'}});av.TextAreaCellEditor=aG;var P=av.Component.create({NAME:aQ,ATTRS:{multiple:{value:false,validator:aU}},EXTENDS:av.BaseOptionsCellEditor,UI_ATTRS:[ab],prototype:{ELEMENT_TEMPLATE:'<select class="'+V+'"></select>',OPTION_TEMPLATE:'<option value="{value}">{label}</option>',getElementsValue:function(){var A=this;if(A.get(ab)){return A._getSelectedOptions().get(a4);}return A.elements.get(a4);},_syncElementsFocus:function(){var A=this;A.elements.focus();},_uiSetMultiple:function(bk){var A=this;var bj=A.elements;if(bk){bj.setAttribute(ab,ab);}else{bj.removeAttribute(ab);}}}});av.DropDownCellEditor=P;var ao=av.Component.create({NAME:D,ATTRS:{selectedAttrName:{value:p}},EXTENDS:av.BaseOptionsCellEditor,prototype:{ELEMENT_TEMPLATE:'<div class="'+V+'"></div>',OPTION_TEMPLATE:'<input class="'+L+'" id="{id}" name="{name}" type="checkbox" value="{value}"/>',OPTION_WRAPPER:'<label class="'+x+'" for="{id}"><span class="'+aY+'">{label}</span></label>',getElementsValue:function(){var A=this;
return A._getSelectedOptions().get(a4);},_syncElementsFocus:function(){var A=this;var bj=A.options;if(bj&&bj.size()){bj.item(0).focus();}},_syncElementsName:function(){var A=this;var bj=A.options;if(bj){bj.setAttribute(m,A.get(aE));}}}});av.CheckboxCellEditor=ao;var K=av.Component.create({NAME:al,EXTENDS:av.CheckboxCellEditor,prototype:{OPTION_TEMPLATE:'<input class="aui-field-input-choice" id="{id}" name="{name}" type="radio" value="{value}"/>',getElementsValue:function(){var A=this;return A._getSelectedOptions().get(a4)[0];}}});av.RadioCellEditor=K;var a=av.Component.create({NAME:M,EXTENDS:av.BaseCellEditor,ATTRS:{bodyContent:{value:U},calendar:{setter:"_setCalendar",validator:J,value:null}},prototype:{ELEMENT_TEMPLATE:'<input class="'+V+'" type="hidden" />',initializer:function(){var A=this;A.on("calendar:select",av.bind(A._onDateSelect,A));},getElementsValue:function(){var A=this;return A.calendar.getFormattedSelectedDates().join(bi);},_afterRender:function(){var A=this;av.DateCellEditor.superclass._afterRender.apply(A,arguments);A.calendar=new av.Calendar(A.get(S)).render(A.bodyNode);},_onDateSelect:function(bj){var A=this;A.elements.val(bj.date.formatted.join(bi));},_setCalendar:function(bj){var A=this;return av.merge({bubbleTargets:A},bj);},_uiSetValue:function(bk){var A=this;var bj=A.calendar;if(bj){if(bk&&aZ(bk)){bk=bk.split(bi);}A.calendar.set("dates",bk);}}}});av.DateCellEditor=a;},"@VERSION@",{requires:["aui-calendar","aui-datatable-events","aui-toolbar","aui-form-validator","escape","overlay","sortable"],skinnable:true});AUI.add("aui-datatable-selection",function(B){var j=B.Lang,s=j.isBoolean,v=j.isString,G=B.getClassName,i=B.cached(function(A){return A.substring(0,1).toUpperCase()+A.substring(1);}),o="cell",m="columnset",g="columnsetChange",r="datatable",E="down",J="esc",u="focused",H="host",p="id",d="keydown",x="left",q="mousedown",D="mouseEvent",w="multiple",I="recordset",f="recordsetChange",l="return",t="right",n="row",c="select",k="selected",y="selectRow",e="tab",z="tabindex",F="tr",h="up",a=G(r,o,k),C=G(r,n,k);var b=B.Base.create("dataTableSelection",B.Plugin.Base,[],{activeColumnIndex:-1,activeRecordIndex:-1,handlerKeyDown:null,selectedCellHash:null,selectedColumnHash:null,selectedRowHash:null,initializer:function(){var A=this;A.selectedCellHash={};A.selectedColumnHash={};A.selectedRowHash={};A.publish({select:{defaultFn:A._defSelectFn}});A.afterHostEvent(A.get(D),A._afterMouseEvent);A.afterHostEvent(g,A._afterHostColumnsetChange);A.afterHostEvent(f,A._afterHostRecordsetChange);A.handlerKeyDown=B.getDoc().on(d,B.bind(A._afterKeyEvent,A));},destroy:function(){var A=this;var K=A.handlerKeyDown;if(K){K.detach();}},getActiveColumn:function(){var A=this;var K=A.get(H);return K.get(m).getColumn(A.activeColumnIndex);},getActiveRecord:function(){var A=this;var K=A.get(H);return K.get(I).getRecord(A.activeRecordIndex);},isCellSelected:function(K){var A=this;return A.selectedCellHash[K.get(p)];},isColumnSelected:function(A){},isRowSelected:function(K){var A=this;return A.selectedRowHash[K.get(p)];},select:function(K,Q){var A=this;var N=A.get(H);var P=N.get(m);var O=N.get(I);var M=P.getColumnByCell(K);var L=O.getRecordByRow(Q||K.ancestor(F));A.activeColumnIndex=P.getColumnIndex(M);A.activeRecordIndex=O.getRecordIndex(L);if(K){A.selectCell(K);}if(A.get(y)&&Q){A.selectRow(Q);}},selectCell:function(K){var A=this;if(!A.get(w)){A.unselectAllCells();}A.selectedCellHash[K.get(p)]=K;K.setAttribute(z,0).focus();K.addClass(a);},selectColumn:function(A){},selectRow:function(K){var A=this;if(!A.get(w)){A.unselectAllRows();}A.selectedRowHash[K.get(p)]=K;K.addClass(C);},toggleCell:function(K,L){var A=this;if(L||!A.isCellSelected(K)){A.selectCell(K);}else{A.unselectCell(K);}},toggleColumn:function(A,K){},toggleRow:function(L,K){var A=this;if(K||!A.isRowSelected(L)){A.selectRow(L);}else{A.unselectRow(L);}},unselectCell:function(K){var A=this;delete A.selectedCellHash[K.get(p)];K.removeAttribute(z);K.removeClass(a);},unselectColumn:function(A){},unselectRow:function(K){var A=this;delete A.selectedRowHash[K.get(p)];K.removeClass(C);},unselectAllCells:function(){var A=this;B.each(A.selectedCellHash,B.bind(A.unselectCell,A));},unselectAllColumns:function(){},unselectAllRows:function(){var A=this;B.each(A.selectedRowHash,B.bind(A.unselectRow,A));},_afterHostColumnsetChange:function(K){var A=this;A._cleanUp();},_afterHostRecordsetChange:function(K){var A=this;A._cleanUp();},_afterMouseEvent:function(K){var A=this;A._handleSelectEvent(K);},_afterKeyEvent:function(N){var A=this;var M=A.get(H);var L=A.getActiveColumn();var K=A.getActiveRecord();if(!M.get(u)||!L||!K){return;}if(M.events){M.events.updateEventPayload(M.getCellNode(K,L),N);}if(N.isNavKey()){if(N.isKey(J)){A._onEscKey(N);}else{if(N.isKey(l)){A._onReturnKey(N);}else{A._navigate(N);}}N.halt();}},_cleanUp:function(){var A=this;A.selectedCellHash={};A.selectedColumnHash={};A.selectedRowHash={};},_defSelectFn:function(K){var A=this;A.select(K.cell,K.row);},_navigate:function(K){var A=this;A._updateNavKeyInfo(K);A._handleSelectEvent(K);},_onEscKey:function(M){var A=this;var L=A.get(H);var K=L.getCellEditor(M.record,M.column);if(K){K.hide();}},_onReturnKey:function(L){var A=this;var K=A.get(H);K._editCell(L);},_handleSelectEvent:function(K){var A=this;A.fire(c,{cell:K.cell,column:K.column,inHead:K.inHead,liner:K.liner,originalEvent:K.originalEvent,row:K.row,record:K.record});},_updateNavKeyInfo:function(A){var T=this;var U=T.get(H);var K=A.originalEvent;var M=U.get(m);var Q=A.column.keyIndex;var S=U.get(I);var N=S.getRecordIndex(A.record);var L=K.ctrlKey||K.metaKey;var R=K.shiftKey;if(K.isKey(x)||(R&&K.isKey(e))){if(L){Q=0;}else{Q--;}}else{if(K.isKey(t)||(!R&&K.isKey(e))){if(L){Q=M.getLength()-1;}else{Q++;}}else{if(K.isKey(E)){if(L){N=S.getLength()-1;}else{N++;}}else{if(K.isKey(h)){if(L){N=0;}else{N--;}}}}}Q=Math.max(Math.min(Q,M.getLength()-1),0);N=Math.max(Math.min(N,S.getLength()-1),0);if(U.events){var O=M.getColumn(Q);var P=S.getRecord(N);U.events.updateEventPayload(U.getCellNode(P,O),A);
}},_setMouseEvent:function(A){return o+i(A);}},{NS:"selection",NAME:"dataTableSelection",ATTRS:{selectRow:{value:false,validator:s},multiple:{value:false,validator:s},mouseEvent:{setter:"_setMouseEvent",value:q,validator:v}}});B.namespace("Plugin").DataTableSelection=b;},"@VERSION@",{requires:["aui-datatable-base"],skinnable:true});AUI.add("aui-datatable",function(a){},"@VERSION@",{skinnable:true,use:["aui-datatable-base","aui-datatable-events","aui-datatable-edit","aui-datatable-selection"]});