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
 * @version    0.7.0
 * @since      0.7.0
 */t("body").on("click",".repeater_add",function(s){s.preventDefault();const l=t(this).data("meta_key");let a=t("#rtabstract_repeater_"+l).clone();const i=t(a).children("div").children("div");t(i).each((p,n)=>{if(t(n).hasClass("close"))return;const e=t(n).children("input"),o=t(e).data("input-key"),d=t(e).attr("id");let r=0,c;typeof d<"u"?(c=d.match(/[a-zA-Z\-\_]*/g),r=h(c[0])+1):r=0,t(e).attr("id",c[0].replace(/-blank/,"")+"-"+o+"-"+r),t(e).attr("name",c[0].replace(/-blank/,"")+"["+r+"]["+o+"]")}),t(a.html()).insertBefore(t(this))});function h(s){const l=s.replace(/-blank/,""),a=t('[id^="'+l+'"]');let i=[];return a.each((p,n)=>{if(t(n).attr("id").match(/[\d*]/g)){const e=t(n).attr("id").match(/[\d*]/g),o=parseInt(e[0]);i.push(o)}}),Math.max(...i)}t("body").on("click",".close button",function(){t(this).parent().parent()[0].remove()});
