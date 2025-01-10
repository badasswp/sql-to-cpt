/**
 * Disabled Component.
 *
 * This function returns a JSX component that is
 * a disabled input text field.
 *
 * @since 1.0.0
 *
 * @returns {JSX.Element}
 */
const Disabled = ({ name }): JSX.Element => {
  return (
    <p>
      <input type="text" value={ name } disabled />
    </p>
  );
}

export default Disabled;
