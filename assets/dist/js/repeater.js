import{j as t}from"./jquery.js";/**
 * Copyright (C) 2023 RayTech Hosting <royk@myraytech.net>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 * @category   Library
 * @package    WordPress
 * @subpackage WPAbstractClasses
 * @author     Kevin Roy <royk@myraytech.net>
 * @license    GPL-v2 <https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html>
 * @version    0.11.3
 * @since      0.7.0
 */t("body").on("click",".repeater_add",function(r){const o=t(this);r.preventDefault();const c=t(o).data("meta_key");let a=t("#rtabstract_repeater_"+c).clone();const s=t(a).children("div").children("div:not(.close)");t(s).each((l,i)=>{if(t(i).hasClass("close"))return;const e=t(i).children("input,select,textarea"),d=t(e).data("input-key"),p=t(e).attr("id");if(typeof p<"u"){let n=p.match(/[a-zA-Z\-\_]*/g);if(typeof n<"u"&&n!==null){let u=h(n[0])>=0?h(n[0])+1:0;t(e).attr("id",n[0].replace(/-blank/,"-"+d+"-"+u)),t(e).attr("name",n[0].replace(/-blank/,"["+u+"]["+d+"]"))}}}),t(a.html()).insertBefore(t(o))});function h(r){const o=r.replace(/-blank/,""),c=t('[id^="'+o+'"]');let a=[];return c.each((s,l)=>{if(t(l).attr("id").match(/[\d*]/g)){const i=t(l).attr("id").match(/[\d*]/g),e=parseInt(i[0]);a.push(e)}}),Math.max(...a)}t("body").on("click",".close button",function(){t(this).parent().parent()[0].remove()});
