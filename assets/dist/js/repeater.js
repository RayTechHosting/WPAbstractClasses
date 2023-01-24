import{j as t}from"./jquery.js";/**
 * Copyright (C) 2020 RayTech Hosting <royk@myraytech.net>
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
 * @version    0.7.0
 * @since      0.7.0
 */t("body").on("click","#repeater_add",function(c){c.preventDefault();const p=t(this).data("meta_key");let n=t("#rtabstract_repeater_"+p).clone();const a=t(n).children("div").children("p");t(a).each((d,l)=>{const e=t(l).children("input")[0],i=t(e).data("input-key"),s=t(e).attr("id");let r=0,o;typeof s<"u"?(o=s.match(/[a-zA-Z\-\_]*/g),r=h(o[0])+1):r=0,t(e).attr("id",o[0].replace(/-blank/,"")+"-"+i+"-"+r),t(e).attr("name",o[0].replace(/-blank/,"")+"["+r+"]["+i+"]")}),t(this).parent().children(".grid").append(n.html())});function h(c){const p=c.replace(/-blank/,""),n=t('[id^="'+p+'"]');let a=[];return n.each((d,l)=>{if(!t(l).attr("id").match(/\-blank/g)){const e=t(n[d]).attr("id").match(/[\d*]/g),i=parseInt(e[0]);a.push(i)}}),Math.max(...a)}t("body").on("click",".close button",function(){t(this).parent().parent()[0].remove()});
