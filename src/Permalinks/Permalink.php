<?php
/**
 * This file is part of the WordPress Abstract Classes theme plugin.
 * 
 * It is distributed under the GNU General Public License.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  Library
 * @package   WPAbstractClasses
 * @author    Kevin Roy <royk@myraytech.net>
 * @copyright 2020 RayTech Hosting <https://www.myraytech.net>
 * @license   GPL v3.0
 * @version   1.0.0
 * @link      https://github.com/myraytech/wordpress-abstract-classes
 * @since     1.0.0
 */
namespace RayTech\WPAbstractClasses\Permalinks;

/**
 * Class Permalink
 * 
 * @package WPAbstractClasses
 */
class Permalink extends AbstractPermalink {
	public function __construct(string $postType)
	{
		$this->setPostType($postType);
		parent::__construct();
	}
}
