/**
 * Notice Component.
 *
 * This function returns a JSX component that is
 * a display notice.
 *
 * @since 1.0.0
 *
 * @returns {JSX.Element}
 */
const Notice = ({ message }): JSX.Element => {
  return message && <nav>{ message }</nav>;
}

export default Notice;
